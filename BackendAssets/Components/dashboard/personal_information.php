
<h4>Personal Information</h4>
                        <form action="" class="singleupdateform">
                            <label for="name">Name</label>
                            <input type="hidden" name="id" value="<?=$userData['address_id']?>">
                            <span class="edit">Edit</span>
                            <br>
                            <div class="block">
                            <input type="text" name="name" value="<?=$userData['name']?>" required disabled>
                            <button type="submit" class="save_button">Save</button>
                            </div>
                        </form>
                        <br>
                        <form action="" class="singleupdateform">
                            <label for="email">Email</label>
                            <input type="hidden" name="id" value="<?=$userData['address_id']?>">
                            <input type="hidden" name="id" value="<?=$userData['address_id']?>">
                            <span class="edit">Edit</span>
                            <br>
                            <div class="block">
                            <input type="text" name="email" value="<?=$userData['email']?>" required disabled>
                            <button type="submit" class="save_button">Save</button>
                            </div>
                        </form>
                        <br>
                        <form action="" class="singleupdateform"> 
                            <label for="phonenumber">Phonenumber</label>
                            <input type="hidden" name="id" value="<?=$userData['address_id']?>">
                            <span class="edit">Edit</span>
                            <br>
                            <div class="block">
                            <input type="text" name="phonenumber" value="<?=$userData['phonenumber']?>" required disabled>
                            <button type="submit" class="save_button">Save</button>
                            </div>
                        </form>
                        <br>
                        <form action="" class="singleupdateform">
                            <label for="country">Country</label>
                            <input type="hidden" name="id" value="<?=$userData['address_id']?>">
                            <span class="edit">Edit</span>
                            <br>
                            <div class="block">
                            <input type="text" name="country" value="<?=$userData['country']?>" required disabled>
                            <button type="submit" class="save_button">Save</button>
                            </div>
                        </form>
                        <br>
                        <form action="" class="singleupdateform">
                            <label for="state">State</label>
                            <input type="hidden" name="id" value="<?=$userData['address_id']?>">
                            <span class="edit">Edit</span>
                            <br>
                            <div class="block">
                            <input type="text" name="state" value="<?=$userData['state']?>" required disabled>
                            <button type="submit" class="save_button">Save</button>
                            </div>
                        </form>
                        <br>
                        <form action="" class="singleupdateform">
                            <label for="city">City</label>
                            <input type="hidden" name="id" value="<?=$userData['address_id']?>">
                            <span class="edit">Edit</span>
                            <br>
                            <div class="block">
                            <input type="text" name="city" value="<?=$userData['city']?>" required disabled>
                            <button type="submit" class="save_button">Save</button>
                            </div>
                        </form>
                        <br>
                        <form action="" class="singleupdateform">
                            <label for="pincode">Pincode</label>
                            <input type="hidden" name="id" value="<?=$userData['address_id']?>">
                            <span class="edit">Edit</span>
                            <br>
                            <div class="block">
                            <input type="text" name="pincode" value="<?=$userData['pincode']?>" required disabled>
                            <button type="submit" class="save_button">Save</button>
                            </div>
                        </form>
                        <br>
                        <form action="" class="singleupdateform">
                            <label for="address">Address</label>
                            <input type="hidden" name="id" value="<?=$userData['address_id']?>">
                            <span class="edit">Edit</span>
                            <br>
                            <div class="block">
                            <input type="text" name="address" value="<?=$userData['address']?>" required disabled>
                            <button type="submit" class="save_button">Save</button>
                            </div>
                        </form>
                        <br>
                        <form method="post" action="<?=BASE_URL?>BackendAssets/mysqlcode/dashboard.php" id="address_change_form">
                            <label for="address_change_select_field">Select address</label>
                            <div class="block">
                                <select name="make_default_address" id="address_change_select_field">
                                    <?php
                                    $fetch_table_name=$conn->prepare("SELECT table_name, default_address FROM ( SELECT 'user_default_address_table' AS table_name, default_address FROM `user_default_address_table` WHERE user_id = $userid UNION SELECT 'user_second_address_table' AS table_name, default_address FROM `user_second_address_table` WHERE user_id = $userid UNION SELECT 'user_third_address_table' AS table_name, default_address FROM `user_third_address_table` WHERE user_id = $userid ) AS combined_addresses ORDER BY default_address DESC LIMIT 25");
                                    if($fetch_table_name->execute())
                                    {
                                        $fetch_table_name_result=$fetch_table_name->get_result();
                                        $table_count=1;
                                        foreach($fetch_table_name_result->fetch_all(MYSQLI_ASSOC) as $tablename)
                                        {
                                            ?>
                                            <option value="<?=$tablename['table_name']?>">
                                                <?=ucwords(str_replace(" table","",str_replace("user","",str_replace("_"," ",$tablename['table_name']))))?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <input type="hidden" name="userid" value="<?=$userid?>">
                        </form> 