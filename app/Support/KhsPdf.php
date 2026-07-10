<?php

namespace App\Support;

use App\Models\Student;
use Illuminate\Support\Collection;

class KhsPdf
{
    private const PAGE_WIDTH = 595;
    private const PAGE_HEIGHT = 842;
    private const MARGIN_X = 48;

    public static function make(Student $student, Collection $krs): string
    {
        $pages = [];
        $rows = $krs->values();
        $page = self::pageHeader($student, $krs);
        $y = 596;

        foreach ($rows as $index => $item) {
            if ($y < 96) {
                $pages[] = $page;
                $page = self::pageTitle('Kartu Hasil Studi (lanjutan)');
                $page .= self::tableHeader(760);
                $y = 714;
            }

            $page .= self::line(48, $y + 18, 548, $y + 18);
            $page .= self::text(54, $y, 9, (string) ($index + 1));
            $page .= self::text(82, $y, 9, $item->course->code);
            $page .= self::text(148, $y, 9, self::limit($item->course->name, 38));
            $page .= self::text(374, $y, 9, (string) $item->course->credits);
            $page .= self::text(426, $y, 9, $item->grade === null ? '-' : (string) $item->grade);
            $page .= self::text(488, $y, 9, $item->grade_letter);
            $y -= 26;
        }

        $page .= self::line(48, $y + 18, 548, $y + 18);
        $page .= self::text(48, 62, 9, 'Dicetak otomatis oleh Sistem KRS & KHS POLIBATAM pada '.now()->format('d/m/Y H:i'));
        $pages[] = $page;

        return self::document($pages);
    }

    private static function pageHeader(Student $student, Collection $krs): string
    {
        $totalCredits = $krs->sum(fn ($item) => $item->course->credits ?? 0);
        $gradedCount = $krs->whereNotNull('grade')->count();

        $content = self::pageTitle('Kartu Hasil Studi (KHS)');
        $content .= self::text(48, 738, 10, 'Nama', true).self::text(148, 738, 10, ': '.$student->name);
        $content .= self::text(48, 718, 10, 'NIM', true).self::text(148, 718, 10, ': '.$student->nim);
        $content .= self::text(48, 698, 10, 'Program Studi', true).self::text(148, 698, 10, ': '.$student->study_program);
        $content .= self::text(330, 738, 10, 'Semester', true).self::text(424, 738, 10, ': '.$student->semester);
        $content .= self::text(330, 718, 10, 'Tahun Akademik', true).self::text(424, 718, 10, ': '.$student->academic_year);
        $content .= self::text(330, 698, 10, 'IP Semester', true).self::text(424, 698, 10, ': '.number_format($student->ips, 2));
        $content .= self::text(48, 670, 10, 'Total SKS: '.$totalCredits.' | Nilai terbit: '.$gradedCount.' mata kuliah');
        $content .= self::tableHeader(642);

        return $content;
    }

    private static function pageTitle(string $title): string
    {
        $content = self::text(48, 804, 15, 'POLITEKNIK NEGERI BATAM', true);
        $content .= self::text(48, 784, 11, 'Sistem Pengisian KRS dan Nilai Akhir');
        $content .= self::line(48, 770, 548, 770);
        $content .= self::text(48, 744, 16, $title, true);

        return $content;
    }

    private static function tableHeader(int $y): string
    {
        $content = self::line(48, $y, 548, $y);
        $content .= self::line(48, $y - 24, 548, $y - 24);
        $content .= self::text(54, $y - 16, 9, 'No', true);
        $content .= self::text(82, $y - 16, 9, 'Kode', true);
        $content .= self::text(148, $y - 16, 9, 'Mata Kuliah', true);
        $content .= self::text(374, $y - 16, 9, 'SKS', true);
        $content .= self::text(426, $y - 16, 9, 'Nilai', true);
        $content .= self::text(488, $y - 16, 9, 'Grade', true);

        return $content;
    }

    private static function text(int $x, int $y, int $size, string $text, bool $bold = false): string
    {
        $font = $bold ? 'F2' : 'F1';

        return "BT /{$font} {$size} Tf {$x} {$y} Td (".self::escape($text).") Tj ET\n";
    }

    private static function line(int $x1, int $y1, int $x2, int $y2): string
    {
        return "{$x1} {$y1} m {$x2} {$y2} l S\n";
    }

    private static function limit(string $text, int $length): string
    {
        return strlen($text) > $length ? substr($text, 0, $length - 3).'...' : $text;
    }

    private static function escape(string $text): string
    {
        $text = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $text) ?: $text;

        return str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], $text);
    }

    private static function document(array $pages): string
    {
        $objects = [
            1 => '<< /Type /Catalog /Pages 2 0 R >>',
            3 => '<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>',
            4 => '<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica-Bold >>',
        ];
        $kids = [];
        $next = 5;

        foreach ($pages as $content) {
            $contentObject = $next++;
            $pageObject = $next++;
            $objects[$contentObject] = "<< /Length ".strlen($content)." >>\nstream\n{$content}endstream";
            $objects[$pageObject] = '<< /Type /Page /Parent 2 0 R /MediaBox [0 0 '.self::PAGE_WIDTH.' '.self::PAGE_HEIGHT.'] /Resources << /Font << /F1 3 0 R /F2 4 0 R >> >> /Contents '.$contentObject.' 0 R >>';
            $kids[] = $pageObject.' 0 R';
        }

        $objects[2] = '<< /Type /Pages /Kids ['.implode(' ', $kids).'] /Count '.count($kids).' >>';
        ksort($objects);

        $pdf = "%PDF-1.4\n";
        $offsets = [0];
        foreach ($objects as $number => $body) {
            $offsets[$number] = strlen($pdf);
            $pdf .= "{$number} 0 obj\n{$body}\nendobj\n";
        }

        $xref = strlen($pdf);
        $count = max(array_keys($objects)) + 1;
        $pdf .= "xref\n0 {$count}\n";
        $pdf .= "0000000000 65535 f \n";
        for ($i = 1; $i < $count; $i++) {
            $pdf .= sprintf("%010d 00000 n \n", $offsets[$i] ?? 0);
        }
        $pdf .= "trailer\n<< /Size {$count} /Root 1 0 R >>\nstartxref\n{$xref}\n%%EOF";

        return $pdf;
    }
}
