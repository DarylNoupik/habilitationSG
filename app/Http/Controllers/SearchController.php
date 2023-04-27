<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search()
            {
                $query = request('q');

                // Get the current path 
               
                $path = request('previous_path');
               

                // Define the routes to redirect to based on the current path
                $routes = [
                    'actions' => 'actions.index',
                    'applications' => 'applications.index',
                    'users' => 'users.index',
                    'fonctions' => 'fonctions.index'
                    // Add more routes as needed
                ];

                // Get the route to redirect to based on the current path
                $route = $routes[$path] ?? 'dashboard';
              
                // If the current path is 'users', use the 'users.index' route instead
                if (strpos(url()->current(), 'users') !== false) {
                    $route = 'users.index';
                }

                // Redirect to the appropriate route with the search query
                return redirect()->route($route, ['q' => $query]);
            }

}
