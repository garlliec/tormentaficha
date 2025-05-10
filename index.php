<?php
// index.php

function listDirectory($dir = '.') {
    $items = scandir($dir);
    $items = array_diff($items, ['.', '..']);

    echo "<ul>";
    foreach ($items as $item) {
        $path = $dir . '/' . $item;
        echo "<li>";
        if (is_dir($path)) {
            // Directory: show toggle arrow
            echo "<span class=\"toggle\">📁 $item</span>";
            echo "<div class=\"nested\">";
            listDirectory($path); // Recursive call
            echo "</div>";
        } else {
            // File: just show link
            echo "<a href=\"$path\">📄 $item</a>";
        }
        echo "</li>";
    }
    echo "</ul>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>📁 Collapsible Directory Listing</title>
    <style>
        body {
            font-family: sans-serif;
            background: #f9f9f9;
            color: #333;
            padding: 20px;
        }

        h1 {
            font-size: 1.8em;
        }

        ul {
            list-style-type: none;
            padding-left: 20px;
        }

        li {
            margin: 5px 0;
        }

        .toggle {
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 4px;
            background-color: #e0e0e0;
        }

        .toggle:hover {
            background-color: #d0d0d0;
        }

        .nested {
            display: none; /* Hidden by default */
            padding-left: 10px;
        }

        .nested.active {
            display: block; /* Show when active */
        }

        /* Arrow icon */
        .toggle::before {
            content: "▶";
            font-size: 0.8em;
            display: inline-block;
            margin-right: 6px;
            transition: transform 0.2s ease;
        }

        .toggle.active::before {
            transform: rotate(90deg); /* Rotate arrow when open */
        }
    </style>
</head>
<body>
    <h1>📁 Collapsible Directory Listing</h1>
    <?php listDirectory(); ?>
    <script>
        // JavaScript to toggle nested directories
        document.querySelectorAll('.toggle').forEach(toggle => {
            toggle.addEventListener('click', () => {
                const nested = toggle.nextElementSibling;
                const isActive = nested.classList.contains('active');

                // Toggle active class
                nested.classList.toggle('active', !isActive);
                toggle.classList.toggle('active', !isActive);
            });
        });
    </script>
</body>
</html>
