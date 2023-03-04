<h1 class="text-2xl font-bold mb-4">Root Categories</h1>
<hr class="mb-4"/>
<table class="table-auto border-collapse w-full">
    <!--<table class="table-auto w-full">-->
    <thead>
    <tr>
        <th class="px-4 py-2 border">Category Name</th>
        <th class="px-4 py-2 border">Total Items</th>
    </tr>
    </thead>
    <tbody>
    <?php if (isset($rootCategories) && $rootCategories): ?>
        <?php foreach ($rootCategories as $category): ?>
            <tr>
                <td class="border px-4 py-2"><?= $category['category_name'] ?></td>
                <td class="border px-4 py-2"><?= $category['total_items'] ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td class="border px-4 py-2 text-red-700">Data not found</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>

