<!-- views/layout.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>BS Commerce</title>
    <link href="https://unpkg.com/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<nav class="bg-gray-800 py-4">
    <div class="container mx-auto flex justify-between items-center px-4">
        <a href="<?= base_url(); ?>" class="text-white font-bold text-xl">BS Commerce</a>
        <ul class="flex">
            <li><a href="<?= base_url('root-category'); ?>" class="text-white hover:text-gray-300 px-4">Root
                    Category</a></li>
            <li><a href="<?= base_url('category-tree'); ?>" class="text-white hover:text-gray-300 px-4">Category
                    Tree</a></li>
        </ul>
    </div>
</nav>

<main class="container mx-auto my-4 min-h-screen">
    <?= $content ?? '' ?>
</main>

<footer class="bg-gray-800 py-4 text-center text-white">
    &copy; <?= date('Y') ?> BS Commerce
</footer>
</body>
</html>
