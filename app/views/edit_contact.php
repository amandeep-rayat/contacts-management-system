<?php include "nav.php" ?>

<link rel="stylesheet" href="css/form.css">

<h1>Edit Contact</h1>
<form action="/contacts-management-system/public/update" method="post" class="center">
    <input type="hidden" name="id" value="<?= $contact['id'] ?>">

    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" value="<?= $contact['name'] ?>"><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" value="<?= $contact['email'] ?>"><br>

    <label for="phone">Phone:</label><br>
    <input type="tel" id="phone" name="phone" value="<?= $contact['phone'] ?>"><br>

    <label for="address">Address:</label><br>
    <textarea type="text" id="address" name="address"><?= $contact['address'] ?></textarea><br>

    <button type="submit">Update</button>

    <button type="reset" class="normal">Reset</button>

    <a href="/contacts-management-system/public/"><button type="button" class="normal">Cancel</button></a>
</form>

<?php include "footer.php" ?>