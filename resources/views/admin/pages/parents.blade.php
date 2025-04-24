<div id="parents-page" class="page-content">
    <div class="content-page">
        <div class="page-header">
            <h2 class="page-title"><i class="fas fa-user-friends"></i> إدارة أولياء الأمور</h2>
            <button class="add-new-btn" id="add-parent-btn"><i class="fas fa-plus"></i> إضافة ولي أمر
                جديد</button>
        </div>

        <table class="data-table">
            <thead>
                <tr>
                    <th>رقم ولي الأمر</th>
                    <th>اسم ولي الأمر</th>
                    <th>الأبناء</th>
                    <th>رقم الهاتف</th>
                    <th>البريد الالكتروني</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @php
                    use App\Models\User;

                    $parents = User::role('parent')
                        ->with(['children'])
                        ->get();
                @endphp
                @foreach ($parents as $parent)
                    <tr data-modal="parent" data-id="{{ $parent->id }}">
                        <td>{{ 'P' . str_pad($parent->id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $parent->name }}</td>
                            <td>
                                @foreach ($parent->children as $child)
                                    <div data-child-id="{{ $child->id }}" class="child">
                                        {{ $child->name ?? '—' }}
                                        <button class="delete-child" data-id="{{ $child->pivot->id }}">🗑️</button>
                                    </div>
                                @endforeach
                            </td>
                            <td>{{ $parent->phone_number }}</td>
                            <td>{{ $parent->email }}</td>
                            <td>
                                <button class="action-btn view-add-btn"><i class="fas fa-plus">إضافة طالب</i></button>
                                <button class="action-btn edit-btn"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete-btn" data-id={{ $parent->id }}><i class="fas fa-trash"></i></button>
                            </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <div class="pagination">
            <a href="#">&laquo;</a>
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">&raquo;</a>
        </div>
    </div>
</div>
