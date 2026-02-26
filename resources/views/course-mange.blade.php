<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management - Awesome App</title>
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <style>
        /* Simple modal styles (local to this view) */
        .modal-backdrop { position: fixed; inset: 0; background: rgba(2,6,23,0.6); display: none; align-items: center; justify-content: center; z-index: 9999; }
        .modal-backdrop.open { display: flex; }
        .modal-dialog { background: #fff; border-radius: 12px; width: 100%; max-width: 820px; padding: 1.25rem; box-shadow: 0 20px 60px rgba(2,6,23,0.4); }
        .modal-header { display:flex; align-items:center; justify-content:space-between; gap:8px; }
        .modal-body { margin-top: 0.75rem; display: grid; gap: 0.75rem; }
        .form-row { display:flex; gap:0.75rem; }
        .form-field { flex:1; display:flex; flex-direction:column; gap:6px; }
        .form-field input[type="text"], .form-field input[type="number"], .form-field textarea { padding:10px 12px; border-radius:8px; border:1px solid var(--border-color); font-size:0.95rem; }
        .modal-actions { display:flex; gap:8px; justify-content:flex-end; margin-top:0.5rem; }
        
        /* Table Styling */
        .courses-table-wrapper { 
            background: #fff; 
            border-radius: 12px; 
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07), 0 1px 3px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            margin-top: 1.5rem;
        }
        
        .courses-table { 
            width: 100%; 
            border-collapse: collapse;
            min-width: 900px;
        }
        
        .courses-table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
        }
        
        .courses-table thead th {
            padding: 16px;
            text-align: left;
            font-weight: 700;
            font-size: 0.875rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        
        .courses-table tbody tr {
            border-bottom: 1px solid #e5e7eb;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }
        
        .courses-table tbody tr:hover {
            background-color: #f9fafb;
            box-shadow: inset 0 0 8px rgba(102, 126, 234, 0.08);
        }
        
        .courses-table tbody tr:last-child {
            border-bottom: none;
        }
        
        .courses-table tbody td {
            padding: 14px 16px;
            vertical-align: middle;
            font-size: 0.95rem;
            color: #374151;
        }
        
        .courses-table .enrolment-key {
            font-family: 'Courier New', monospace;
            background-color: #f3f4f6;
            padding: 4px 8px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.85rem;
            word-break: break-all;
        }
        
        .courses-table .status-active {
            color: #10b981;
            font-weight: 700;
        }
        
        .courses-table .status-inactive {
            color: #9ca3af;
            font-weight: 500;
        }
        
        .courses-table .table-description {
            color: #6b7280;
            max-width: 250px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        
        /* Pagination Styling */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 3rem;
            margin-bottom: 2rem;
            padding: 2rem;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
            border-radius: 12px;
            border: 1px solid rgba(102, 126, 234, 0.1);
        }
        
        .pagination {
            display: flex;
            gap: 8px;
            list-style: none;
            padding: 0;
            margin: 0;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }
        
        .pagination li {
            display: inline-block;
        }
        
        .pagination a, .pagination span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 14px;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-width: 44px;
            height: 44px;
            color: #374151;
            background: #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            position: relative;
        }
        
        .pagination a::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 10px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
        }
        
        .pagination a:hover {
            border-color: #667eea;
            color: #fff;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
            transform: translateY(-2px);
        }
        
        .pagination .active span {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            border-color: #667eea;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            font-weight: 700;
        }
        
        .pagination .disabled span {
            color: #d1d5db;
            cursor: not-allowed;
            background: #f9fafb;
            border-color: #e5e7eb;
            box-shadow: none;
        }
        
        /* Arrow styling for prev/next */
        .pagination a[rel="prev"]::before,
        .pagination a[rel="next"]::before {
            content: '';
        }
        
        .pagination li:first-child a,
        .pagination li:last-child a {
            min-width: 44px;
        }
        
        /* Page info text */
        .pagination .page-info {
            color: #6b7280;
            font-size: 0.85rem;
            margin: 0 12px;
            font-weight: 500;
        }
        
        @media (max-width:640px) { 
            .form-row { flex-direction:column; }
            .courses-table { min-width: auto; }
            .pagination-wrapper { 
                margin-top: 2rem;
                padding: 1.5rem;
            }
            .pagination { gap: 6px; }
            .pagination a, .pagination span {
                padding: 8px 12px;
                min-width: 40px;
                height: 40px;
                font-size: 0.8rem;
            }
        }
    </style>
</head>

<body>
    <div class="page-wrapper">
        <nav class="navbar">
            <div class="nav-container">
                <div class="logo">Awesome App</div>
                <div class="user-info">
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <span class="user-badge {{ Auth::user()->role === 'admin' ? 'admin-badge' : 'user-badge' }}">{{ ucfirst(Auth::user()->role) }}</span>
                </div>
            </div>
        </nav>

        <main class="main-content">
            <section class="cards-section">
                <div class="section-header" style="display:flex;align-items:center;justify-content:space-between;gap:1rem;">
                    <div>
                        <h2 class="section-title">Course Management</h2>
                        <p class="section-subtitle">Create, view, edit and delete courses</p>
                    </div>

                    <div>
                        <button id="openAddCourse" class="btn btn-primary">+ Add Course</button>
                    </div>
                </div>

                @if($courses->isEmpty())
                    <div class="empty-state">
                        <div class="empty-icon">📭</div>
                        <h3>No Courses Available</h3>
                        <p>Add your first course with the button above.</p>
                    </div>
                @else
                    <div class="courses-table-wrapper">
                        <table class="courses-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Teacher</th>
                                    <th>Genre</th>
                                    <th>Duration</th>
                                    <th>Enrolment Key</th>
                                    <th>Capacity</th>
                                    <th>Place</th>
                                    <th>Active</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($courses as $course)
                                    <tr>
                                        <td><strong>{{ $course->name }}</strong></td>
                                        <td class="table-description">{{ $course->description ?? '-' }}</td>
                                        <td>{{ $course->teacher ?? '-' }}</td>
                                        <td>{{ $course->genre ?? '-' }}</td>
                                        <td>{{ $course->duration ?? '-' }}</td>
                                        <td><span class="enrolment-key">{{ $course->enrolment_key ?? '-' }}</span></td>
                                        <td>{{ $course->capacity ?? '-' }}</td>
                                        <td>{{ $course->place ?? '-' }}</td>
                                        <td>
                                            @if($course->is_active) 
                                                <span class="status-active">✓ Active</span> 
                                            @else 
                                                <span class="status-inactive">○ Inactive</span> 
                                            @endif
                                        </td>
                                        <td style="display:flex;gap:8px;flex-wrap:wrap">
                                            <a  class="btn" style="background:#eef2ff;color:#3730a3;padding:8px 10px;border-radius:8px;text-decoration:none;font-weight:700;font-size:0.85rem;">View</a>
                                            <a  class="btn" style="background:linear-gradient(90deg,#667eea,#764ba2);color:#fff;padding:8px 10px;border-radius:8px;text-decoration:none;font-weight:700;font-size:0.85rem;">Edit</a>
                                            <form method="POST" onsubmit="return confirm('Delete this course?');" style="display:inline-block;margin:0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn" style="background:#fff0f0;color:#c92a2a;padding:8px 10px;border-radius:8px;border:1px solid #fbcaca;font-weight:700;font-size:0.85rem;">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    @if($courses->hasPages())
                        <div class="pagination-wrapper">
                            {{ $courses->links() }}
                        </div>
                    @endif
                @endif
            </section>

                <!-- Add Course Modal -->
                <div id="addCourseModalBackdrop" class="modal-backdrop" aria-hidden="true" role="dialog" aria-modal="true">
                    <div class="modal-dialog" role="document" aria-labelledby="addCourseTitle">
                        <div class="modal-header">
                            <h3 id="addCourseTitle">Add Course</h3>
                            <button id="closeAddCourse" aria-label="Close" class="btn" style="background:transparent;border:none;font-weight:800;color:#374151">✕</button>
                        </div>
                        <div class="modal-body">
                            <form id="addCourseForm" method="POST"  action="{{ route('create-course') }}">
                                @csrf
                                <div class="form-row">
                                    <div class="form-field">
                                        <label>Name</label>
                                        <input name="name" type="text" required>
                                    </div>
                                    <div class="form-field">
                                        <label>Teacher</label>
                                        <input name="teacher" type="text">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-field">
                                        <label>Genre</label>
                                        <input name="genre" type="text">
                                    </div>
                                    <div class="form-field">
                                        <label>Duration</label>
                                        <input name="duration" type="text" placeholder="e.g. 8 weeks">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-field" style="flex:2">
                                        <label>Description</label>
                                        <textarea name="description" rows="12"></textarea>
                                    </div>
                                    <div class="form-field" style="flex:1">
                                        <label>Enrolment Key</label>
                                        <input readonly  name="enrolment_key" value="{{ bin2hex(random_bytes(10)) }}" type="text">
                                        <label>Capacity</label>
                                        <input name="capacity" type="number" min="1">
                                        <label>Place</label>
                                        <input name="place" type="text">
                                        <label style="display:flex;align-items:center;gap:8px;margin-top:8px;"><input type="checkbox" name="is_active" value="1"> Active</label>
                                    </div>
                                </div>

                                <div class="modal-actions">
                                    <button type="button" id="cancelAddCourse" class="btn" style="background:#eef2ff;color:#3730a3;padding:8px 12px;border-radius:8px;font-weight:700;">Cancel</button>
                                    <button type="submit" class="btn btn-primary" style="padding:8px 12px;border-radius:8px;">Create Course</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                    (function(){
                        var openBtn = document.getElementById('openAddCourse');
                        var backdrop = document.getElementById('addCourseModalBackdrop');
                        var closeBtn = document.getElementById('closeAddCourse');
                        var cancelBtn = document.getElementById('cancelAddCourse');
                        function open(){ backdrop && (backdrop.classList.add('open'), backdrop.setAttribute('aria-hidden','false')); var f = document.querySelector('#addCourseForm [name=name]'); f && f.focus(); }
                        function close(){ backdrop && (backdrop.classList.remove('open'), backdrop.setAttribute('aria-hidden','true')); }
                        openBtn && openBtn.addEventListener('click', function(e){ e.preventDefault(); open();});
                        closeBtn && closeBtn.addEventListener('click', close);
                        cancelBtn && cancelBtn.addEventListener('click', close);
                        backdrop && backdrop.addEventListener('click', function(e){ if(e.target===backdrop) close(); });
                        document.addEventListener('keydown', function(e){ if(e.key==='Escape') close(); });
                    })();
                </script>

            </footer>
        </main>
    </div>
</body>

</html>
