<?php

namespace App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\EloquentDataTable;

trait DataTableTrait
{
    public function getActionButtons($row, $routePrefix) {
        return '
            <form action="' . route($routePrefix . '.edit', $row->UserID) . '" method="GET" style="display:inline;">
                <button type="submit" class="edit-button">Sửa</button>
            </form>
            <form action="' . route($routePrefix . '.destroy', $row->UserID) . '" method="POST" style="display:inline;">
                ' . csrf_field() . '
                ' . method_field('DELETE') . '
                <button type="button" class="delete-button" onclick="showDeleteModal(event, this)">Xóa</button>
            </form>
        ';
    }
}
