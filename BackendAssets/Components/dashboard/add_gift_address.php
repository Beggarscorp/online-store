
<div class="address_div_3">
    <h4>Add your gift address</h4>
    <?php
    $gift_Address_sql = $conn->prepare("SELECT * FROM `user_third_address_table` WHERE user_id=$userid");
    $gift_Address_sql->execute();
    $gift_address = $gift_Address_sql->get_result()->fetch_assoc();

    ?>
    <form action="<?= BASE_URL ?>BackendAssets/mysqlcode/dashboard.php" method="post">
        <div class="form_group">
            <label for="name">Name :</label>
            <input type="text" name="name" id="name" value="<?= isset($gift_address['name']) ? $gift_address['name'] : '' ?>" required placeholder="Enter your name">
        </div>

        <div class="form_group">
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" value="<?= isset($gift_address['email']) ? $gift_address['email'] : '' ?>" required placeholder="Enter your email">
        </div>

        <div class="form_group">
            <label for="phonenumber">Number</label>
            <input type="number" name="phonenumber" id="phonenumber" value="<?= isset($gift_address['phonenumber']) ? $gift_address['phonenumber'] : '' ?>" required placeholder="Enter your phonenumber">
        </div>

        <div class="form_group">
            <label for="country">Country :</label>
            <input type="text" name="country" id="country" value="<?= isset($gift_address['country']) ? $gift_address['country'] : '' ?>" required placeholder="Enter your country">
        </div>

        <div class="form_group">
            <label for="state">State :</label>
            <input type="text" name="state" id="state" value="<?= isset($gift_address['state']) ? $gift_address['state'] : '' ?>" required placeholder="Enter your state">
        </div>

        <div class="form_group">
            <label for="city">City :</label>
            <input type="text" name="city" id="city" value="<?= isset($gift_address['city']) ? $gift_address['city'] : '' ?>" required placeholder="Enter your city">
        </div>

        <div class="form_group">
            <label for="pincode">Pincode :</label>
            <input type="text" name="pincode" id="pincode" value="<?= isset($gift_address['pincode']) ? $gift_address['pincode'] : '' ?>" required placeholder="Enter your pincode">
        </div>

        <div class="form_group">
            <label for="address">Address</label>
            <input type="text" name="address" id="address" required placeholder="Flat/House no./Floor/Building" value="<?= isset($gift_address['address']) ? $gift_address['address'] : '' ?>">
        </div>

        <button type="submit" name="update_third_address">Add Address</button>
    </form>
</div>