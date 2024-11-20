<div class="address_div_2">
    <h4>Add your office address</h4>
    <?php
    $office_Address_sql = $conn->prepare("SELECT * FROM `user_second_address_table` WHERE user_id=$userid");
    $office_Address_sql->execute();
    $office_address = $office_Address_sql->get_result()->fetch_assoc();

    ?>
    <form action="<?= BASE_URL ?>BackendAssets/mysqlcode/dashboard.php" method="post">
        <div class="form_group">
            <label for="name">Name :</label>
            <input type="text" name="name" id="name" value="<?= isset($office_address['name']) ? $office_address['name'] : '' ?>" required placeholder="Enter your name">
        </div>

        <div class="form_group">
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" value="<?= isset($office_address['email']) ? $office_address['email'] : '' ?>" required placeholder="Enter your email">
        </div>

        <div class="form_group">
            <label for="phonenumber">Number</label>
            <input type="number" name="phonenumber" id="phonenumber" value="<?= isset($office_address['phonenumber']) ? $office_address['phonenumber'] : '' ?>" required placeholder="Enter your phonenumber">
        </div>

        <div class="form_group">
            <label for="country">Country :</label>
            <input type="text" name="country" id="country" value="<?= isset($office_address['country']) ? $office_address['country'] : '' ?>" required placeholder="Enter your country">
        </div>

        <div class="form_group">
            <label for="state">State :</label>
            <input type="text" name="state" id="state" value="<?= isset($office_address['state']) ? $office_address['state'] : '' ?>" required placeholder="Enter your state">
        </div>

        <div class="form_group">
            <label for="city">City :</label>
            <input type="text" name="city" id="city" value="<?= isset($office_address['city']) ? $office_address['city'] : '' ?>" required placeholder="Enter your city city">
        </div>

        <div class="form_group">
            <label for="pincode">Pincode :</label>
            <input type="text" name="pincode" id="pincode" value="<?= isset($office_address['pincode']) ? $office_address['pincode'] : '' ?>" required placeholder="Enter your pincode">
        </div>

        <div class="form_group">
            <label for="address">Address</label>
            <input type="text" name="address" id="address" value="<?= isset($office_address['address']) ? $office_address['address'] : '' ?>" required placeholder="Flat/House no./Floor/Building">
        </div>

        <button type="submit" name="update_second_address">Add Address</button>
    </form>
</div>