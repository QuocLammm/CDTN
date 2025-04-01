<?php

namespace App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\EloquentDataTable;

trait DataTableTrait
{
    public function getDataTableResponse($query, Request $request, $searchColumn = 'FullName')
    {
        try {
            // Xử lý tìm kiếm
            if ($request->has('search') && isset($request->get('search')['value'])) {
                $search = $request->get('search')['value'];
                $query->where($searchColumn, 'LIKE', '%' . $search . '%');
            }

            return (new EloquentDataTable($query))
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    return '
                        <form action="' . route(request()->route()->getName() . '.edit', $row->id) . '" method="GET" style="display:inline;">
                            <button type="submit" class="edit-button">Sửa</button>
                        </form>
                        <form action="' . route(request()->route()->getName() . '.destroy', $row->id) . '" method="POST" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="button" class="delete-button" onclick="showDeleteModal(event, this)">Xóa</button>
                        </form>
                    ';
                })
                ->make(true);
        } catch (\Exception $e) {
            Log::error('Lỗi lấy dữ liệu DataTables: ' . $e->getMessage());
            return response()->json(['error' => 'Đã xảy ra lỗi khi lấy dữ liệu'], 500);
        }
    }
}
