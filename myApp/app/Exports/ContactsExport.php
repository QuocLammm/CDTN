<?php

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ContactsExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        return Contact::all()->map(function ($contact) {
            return [
                'Họ tên'     => $contact->full_name,
                'Email'      => $contact->email,
                'SĐT'        => $contact->phone,
                'Tiêu đề'    => $contact->subject,
                'Trạng thái' => $contact->status == 'unread' ? 'Chưa đọc' : 'Đã đọc',
                'Ngày gửi'   => $contact->sent_date,
            ];
        });
    }

    public function headings(): array
    {
        return ['Họ tên', 'Email', 'SĐT', 'Tiêu đề', 'Trạng thái', 'Ngày gửi'];
    }

    public function styles(Worksheet $sheet)
    {
        $rows = Contact::count();
        for ($i = 2; $i <= $rows + 1; $i++) {
            $cell = 'E' . $i;
            $status = $sheet->getCell($cell)->getValue();
            if ($status === 'Chưa đọc') {
                $sheet->getStyle($cell)->getFont()->getColor()->setRGB('FF0000'); // đỏ
            } else {
                $sheet->getStyle($cell)->getFont()->getColor()->setRGB('008000'); // xanh
            }
        }

        return [];
    }
}
