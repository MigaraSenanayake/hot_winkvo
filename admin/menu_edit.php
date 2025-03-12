<?php include('includes/header.php'); ?>

<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Edit Food or Beverage Item
                <a href="menu_items.php" class="btn btn-outline-danger float-end">Back</a>
            </h4>
        </div>

        <div class="card_body px-3 mt-2">
            <?php alertMessage(); ?>

            <form action="code.php" method="POST">
            <div class="row">
                <?php
                if (isset($_GET['id'])) {
                    $menuId = trim($_GET['id']);
                    if (!empty($menuId)) {
                        $menuData = getById('menu', $menuId);

                        if ($menuData && $menuData['status'] == 200) {
                            $menu = $menuData['data'];
                        } else {
                            echo '<h5>' . htmlspecialchars($menuData['message']) . '</h5>';
                            return false;
                        }
                    } else {
                        echo '<h5>Id Not Found</h5>';
                        return false;
                    }
                } else {
                    echo '<h5>Id Not given in parameters</h5>';
                    return false;
                }
                ?>

                <!-- Hidden input to store user ID -->
                <input type="hidden" name="menuId" value="<?= htmlspecialchars($menu['id']); ?>">

                <div class="col-md-12 mb-4">
                        <label for="name">Item Name *</label>
                        <input type="text" name="name" required value="<?= htmlspecialchars($menu['name']); ?>" class="form-control" />
                    </div>     

                    <div class="col-md-6 mb-4">
                        <label for="menu_cat">Item Category *</label>
                        <select name="menu_cat" class="form-select" required>                            
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'Appetizer') ? 'selected' : ''; ?>>Appetizer</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'Salad') ? 'selected' : ''; ?>>Salad</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'Sandwich') ? 'selected' : ''; ?>>Sandwich</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'Soup') ? 'selected' : ''; ?>>Soup</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'Oriental Fusion') ? 'selected' : ''; ?>>Oriental Fusion</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'Main Affair') ? 'selected' : ''; ?>>Main Affair</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'Curry Corner') ? 'selected' : ''; ?>>Curry Corner</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'Vegetable Dish') ? 'selected' : ''; ?>>Vegetable Dish</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'Pasta') ? 'selected' : ''; ?>>Pasta</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'Hot Beverage') ? 'selected' : ''; ?>>Hot Beverage</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'Cold Beverage') ? 'selected' : ''; ?>>Cold Beverage</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'Dessert') ? 'selected' : ''; ?>>Dessert</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'BFW1') ? 'selected' : ''; ?>>BFW1</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'BFW2') ? 'selected' : ''; ?>>BFW2</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'BFW3') ? 'selected' : ''; ?>>BFW3</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'BFW4') ? 'selected' : ''; ?>>BFW4</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'BFW5') ? 'selected' : ''; ?>>BFW5</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'BFW6') ? 'selected' : ''; ?>>BFW6</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'BFW7') ? 'selected' : ''; ?>>BFW7</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'BFW8') ? 'selected' : ''; ?>>BFW8</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'BFSL1') ? 'selected' : ''; ?>>BFSL1</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'BFSL2') ? 'selected' : ''; ?>>BFSL2</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'BFSL3') ? 'selected' : ''; ?>>BFSL3</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'BFSL4') ? 'selected' : ''; ?>>BFSL4</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'BFSL5') ? 'selected' : ''; ?>>BFSL5</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'BFSL6') ? 'selected' : ''; ?>>BFSL6</option>                            
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'BFSL7') ? 'selected' : ''; ?>>BFSL7</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'BFSL8') ? 'selected' : ''; ?>>BFSL8</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'BFSL9') ? 'selected' : ''; ?>>BFSL9</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'BFSL10') ? 'selected' : ''; ?>>BFSL10</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'BFSL11') ? 'selected' : ''; ?>>BFSL11</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'BFSL12') ? 'selected' : ''; ?>>BFSL12</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'LU1') ? 'selected' : ''; ?>>LU1</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'LU2') ? 'selected' : ''; ?>>LU2</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'LU3') ? 'selected' : ''; ?>>LU3</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'LU4') ? 'selected' : ''; ?>>LU4</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'LU5') ? 'selected' : ''; ?>>LU5</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'LU6') ? 'selected' : ''; ?>>LU6</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'LU7') ? 'selected' : ''; ?>>LU7</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'LU8') ? 'selected' : ''; ?>>LU8</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'LU9') ? 'selected' : ''; ?>>LU9</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'LU10') ? 'selected' : ''; ?>>LU10</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'LU11') ? 'selected' : ''; ?>>LU11</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'LU12') ? 'selected' : ''; ?>>LU12</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'LU13') ? 'selected' : ''; ?>>LU13</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'LU14') ? 'selected' : ''; ?>>LU14</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'LU15') ? 'selected' : ''; ?>>LU15</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'LU16') ? 'selected' : ''; ?>>LU16</option>

                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI1') ? 'selected' : ''; ?>>DI1</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI2') ? 'selected' : ''; ?>>DI2</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI3') ? 'selected' : ''; ?>>DI3</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI4') ? 'selected' : ''; ?>>DI4</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI5') ? 'selected' : ''; ?>>DI5</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI6') ? 'selected' : ''; ?>>DI6</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI7') ? 'selected' : ''; ?>>DI7</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI8') ? 'selected' : ''; ?>>DI8</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI9') ? 'selected' : ''; ?>>DI9</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI10') ? 'selected' : ''; ?>>DI10</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI11') ? 'selected' : ''; ?>>DI11</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI12') ? 'selected' : ''; ?>>DI12</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI13') ? 'selected' : ''; ?>>DI13</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI14') ? 'selected' : ''; ?>>DI14</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI15') ? 'selected' : ''; ?>>DI15</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI16') ? 'selected' : ''; ?>>DI16</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI17') ? 'selected' : ''; ?>>DI17</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI18') ? 'selected' : ''; ?>>DI18</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI19') ? 'selected' : ''; ?>>DI19</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI20') ? 'selected' : ''; ?>>DI20</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI21') ? 'selected' : ''; ?>>DI21</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI22') ? 'selected' : ''; ?>>DI22</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI23') ? 'selected' : ''; ?>>DI23</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI24') ? 'selected' : ''; ?>>DI24</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI25') ? 'selected' : ''; ?>>DI25</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI26') ? 'selected' : ''; ?>>DI26</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI27') ? 'selected' : ''; ?>>DI27</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI28') ? 'selected' : ''; ?>>DI28</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI29') ? 'selected' : ''; ?>>DI29</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI30') ? 'selected' : ''; ?>>DI30</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI31') ? 'selected' : ''; ?>>DI31</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI32') ? 'selected' : ''; ?>>DI32</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI33') ? 'selected' : ''; ?>>DI33</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI34') ? 'selected' : ''; ?>>DI34</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI35') ? 'selected' : ''; ?>>DI35</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI36') ? 'selected' : ''; ?>>DI36</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI37') ? 'selected' : ''; ?>>DI37</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI38') ? 'selected' : ''; ?>>DI38</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI39') ? 'selected' : ''; ?>>DI39</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI40') ? 'selected' : ''; ?>>DI40</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI41') ? 'selected' : ''; ?>>DI41</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI42') ? 'selected' : ''; ?>>DI42</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI43') ? 'selected' : ''; ?>>DI43</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI44') ? 'selected' : ''; ?>>DI44</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI45') ? 'selected' : ''; ?>>DI45</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI46') ? 'selected' : ''; ?>>DI46</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI47') ? 'selected' : ''; ?>>DI47</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI48') ? 'selected' : ''; ?>>DI48</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI49') ? 'selected' : ''; ?>>DI49</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI50') ? 'selected' : ''; ?>>DI50</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI51') ? 'selected' : ''; ?>>DI51</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI52') ? 'selected' : ''; ?>>DI52</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI53') ? 'selected' : ''; ?>>DI53</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI54') ? 'selected' : ''; ?>>DI54</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI55') ? 'selected' : ''; ?>>DI55</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI56') ? 'selected' : ''; ?>>DI56</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI57') ? 'selected' : ''; ?>>DI57</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI58') ? 'selected' : ''; ?>>DI58</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI59') ? 'selected' : ''; ?>>DI59</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI60') ? 'selected' : ''; ?>>DI60</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI61') ? 'selected' : ''; ?>>DI61</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI62') ? 'selected' : ''; ?>>DI62</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI63') ? 'selected' : ''; ?>>DI63</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI64') ? 'selected' : ''; ?>>DI64</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI65') ? 'selected' : ''; ?>>DI65</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI66') ? 'selected' : ''; ?>>DI66</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI67') ? 'selected' : ''; ?>>DI67</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI68') ? 'selected' : ''; ?>>DI68</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI69') ? 'selected' : ''; ?>>DI69</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI70') ? 'selected' : ''; ?>>DI70</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI71') ? 'selected' : ''; ?>>DI71</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'DI72') ? 'selected' : ''; ?>>DI72</option>
                            
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'TP1') ? 'selected' : ''; ?>>DI72</option>
                            <option <?= (isset($menu['menu_cat']) && $menu['menu_cat'] == 'TP2') ? 'selected' : ''; ?>>DI72</option>
                            
                            
                        </select>
                    </div>
                                
                    <div class="col-md-6 mb-4">
                        <label for="price">Price *</label>
                        <input type="number" name="price" required value="<?= htmlspecialchars($menu['price']); ?>" class="form-control" />
                    </div>                   

                   

                    <div class="col-md-12 mb-4 text-end">
                        <button type="submit" name="update_menu" class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="form_validation.js"></script>
<link rel="stylesheet" href="styles.css">

<?php include('includes/footer.php'); ?>
