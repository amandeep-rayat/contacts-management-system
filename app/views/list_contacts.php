<?php include "nav.php" ?>

<link rel="stylesheet" href="css/css_table.css">
<h1>Contacts List</h1>

<div class="table-top">
    <a href="/contacts-management-system/public/add" style="text-decoration: none;">
        <button type="button">+ Add Contact</button>
    </a>
    <form action="/contacts-management-system/public/search" method="get">
        <input type="text" name="query" placeholder="Search contacts by name or email">
    </form>
    <select name="pagelimit">
        <option>5 / page</option>
        <option>10 / page</option>
        <option>15 / page</option>
    </select>
</div>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="contactsTableBody">
        <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?= htmlspecialchars($contact['name']) ?></td>
                <td><?= htmlspecialchars($contact['email']) ?></td>
                <td><?= htmlspecialchars($contact['phone']) ?></td>
                <td><?= htmlspecialchars($contact['address']) ?></td>
                <td>
                    <a href="/contacts-management-system/public/edit?id=<?= $contact['id'] ?>"><button>Edit</button></a>
                    <a href="/contacts-management-system/public/delete?id=<?= $contact['id'] ?>"><button>Delete</button></a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($contacts)): ?>
            <tr>
                <td colspan="5">No contacts found</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php if ($totalPages > 0): ?>
    <div style="text-align: center;">
        <div class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a <?php if ($i == 1) echo ' class="active-a"' ?>><?php echo $i ?></a>
            <?php endfor; ?>
        </div>
    </div>
<?php endif; ?>

<script src="js/script.js"></script>

<?php include "footer.php" ?>