<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            
            <h1>Average posts per user: {{ $average }}</h1>
            
            <h2>{{ $averageComments }}</h2>
            
            <h4>Mem usage: {{ memory_get_peak_usage() / (1024 * 1024) }}</h4>

            <!-- Table of users -->
            <table>
                <thead>
                    <th>User</th>
                    <th>Num posts</th>
                </thead>

                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td>
                                {{ $user->posts->count() }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </body>
</html>
