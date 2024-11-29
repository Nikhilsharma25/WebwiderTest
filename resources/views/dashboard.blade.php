<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        #searchData {
            width: 100%;
            max-width: 300px;
            margin-bottom: 20px;
        }
        #posts-table {
            width: 100%;
            border-collapse: collapse;
        }
        #posts-table th, #posts-table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        #posts-table th {
            background-color: #f8f9fa;
        }
        .logout-btn {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Posts</h1>
        
        <input type="text" id="searchData" class="form-control" placeholder="Search posts...">

        <table id="posts-table" class="table">
            <thead>
                <tr>
                    <th>Post Name</th>
                    <th>User Name</th>
                    <th>Category Name</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($postData as $post)
                    <tr>
                        <td>{{ $post->name }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>{{ $post->category->name }}</td>
                    </tr>
                @endforeach
            
            </tbody>
        </table>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger logout-btn">Logout</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchData').on('input', function () {
                const searchQuery = $(this).val();

                if (searchQuery.length > 0) {
                    $.ajax({
                        url: '/dashboard/getPostsData',
                        method: 'GET',
                        data: {
                            search: searchQuery
                        },
                        success: function(data) {
                            const tableBody = $('#posts-table tbody');
                            tableBody.empty(); 
                            if (data.length > 0) {
                                
                                $.each(data, function(index, post) {
                                    const row = `
                                        <tr>
                                            <td>${post.name}</td>
                                            <td>${post.user ? post.user.name : 'N/A'}</td>
                                            <td>${post.category ? post.category.name : 'N/A'}</td>
                                        </tr>
                                    `;
                                    tableBody.append(row);
                                });
                            } else {
                                tableBody.html('<tr><td colspan="3">No posts found.</td></tr>');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching data:', error);
                            alert('There was an error fetching the posts. Please try again later.');
                        }
                    });
                } else {
                    $('#posts-table tbody').empty();
                }
            });
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
