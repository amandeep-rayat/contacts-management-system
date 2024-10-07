<?php include "nav.php" ?>

<link rel="stylesheet" href="css/form.css">

<h1>Add Contact</h1>
<form method="post" action="" class="center">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone" pattern="\d{10}" title="10 digit phone number" required>

    <label for="address">Address:</label>
    <textarea id="address" name="address"></textarea>

    <button type="submit">Add Contact</button>

    <button type="reset" class="normal">Clear</button>

    <a href="/contacts-management-system/public/"><button type="button" class="normal">Cancel</button></a>
</form>

<?php include "footer.php" ?>