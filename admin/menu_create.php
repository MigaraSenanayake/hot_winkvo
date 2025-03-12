<?php include('includes/header.php'); ?>

<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Add Food or Beverage Item
                <a href="menu_items.php" class="btn btn-outline-danger float-end">Back</a>
            </h4>
        </div>

        <div class="card_body px-3 mt-2">
            <?php alertMessage(); ?>

            <form action="code.php" method="POST">
                <div class="row">
                                       

                    <div class="col-md-12 mb-4">
                        <label for="name">Item Name *</label>
                        <input type="text" name="name" required class="form-control" />
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="menu_cat">Item Category *</label>
                        <select name="menu_cat" required class="form-select" >
                            <option value="" disabled selected>Select Category</option>    
                            <option>Appetizer</option>
                            <option>Salad</option>
                            <option>Sandwich</option>
                            <option>Soup</option>
                            <option>Oriental Fusion</option>
                            <option>Main Affair</option>
                            <option>Curry Corner</option>
                            <option>Vegetable Dish</option>
                            <option>Pasta</option>
                            <option>Hot Beverage</option>
                            <option>Cold Beverage</option>
                            <option>Dessert</option>
                            <option>BFW1</option>
                            <option>BFW2</option>
                            <option>BFW3</option>
                            <option>BFW4</option>
                            <option>BFW5</option>
                            <option>BFW6</option>
                            <option>BFW7</option>
                            <option>BFW8</option>   
                            <option>BFSL1</option>
                            <option>BFSL2</option>
                            <option>BFSL3</option>
                            <option>BFSL4</option>
                            <option>BFSL5</option>
                            <option>BFSL6</option>
                            <option>BFSL7</option>
                            <option>BFSL8</option>
                            <option>BFSL9</option>
                            <option>BFSL10</option>
                            <option>BFSL11</option>
                            <option>BFSL12</option>
                            <option>LU1</option>
                            <option>LU2</option>
                            <option>LU3</option>
                            <option>LU4</option>
                            <option>LU5</option>
                            <option>LU6</option>
                            <option>LU7</option>
                            <option>LU8</option>
                            <option>LU9</option>
                            <option>LU10</option>
                            <option>LU11</option>
                            <option>LU12</option>
                            <option>LU13</option>
                            <option>LU14</option>
                            <option>LU15</option>
                            <option>LU16</option>
                            
                            <option>DI1</option>
                            <option>DI2</option>
                            <option>DI3</option>                           
                            <option>DI4</option>
                            <option>DI5</option>
                            <option>DI6</option>
                            <option>DI7</option>
                            <option>DI8</option>
                            <option>DI9</option>
                            <option>DI10</option>
                            <option>DI11</option>
                            <option>DI12</option>
                            <option>DI13</option>
                            <option>DI14</option>
                            <option>DI15</option>
                            <option>DI16</option>
                            <option>DI17</option>
                            <option>DI18</option>
                            <option>DI19</option>
                            <option>DI20</option>
                            <option>DI21</option>
                            <option>DI22</option>
                            <option>DI23</option>
                            <option>DI24</option>
                            <option>DI25</option>
                            <option>DI26</option>
                            <option>DI27</option>
                            <option>DI28</option>
                            <option>DI29</option>
                            <option>DI30</option>
                            <option>DI31</option>
                            <option>DI32</option>
                            <option>DI33</option>
                            <option>DI34</option>
                            <option>DI35</option>
                            <option>DI36</option>
                            <option>DI37</option>
                            <option>DI38</option>
                            <option>DI39</option>
                            <option>DI40</option>
                            <option>DI41</option>
                            <option>DI42</option>
                            <option>DI43</option>
                            <option>DI44</option>
                            <option>DI45</option>
                            <option>DI46</option>
                            <option>DI47</option>
                            <option>DI48</option>
                            <option>DI49</option>
                            <option>DI50</option>
                            <option>DI51</option>
                            <option>DI52</option>
                            <option>DI53</option>
                            <option>DI54</option>
                            <option>DI55</option>
                            <option>DI56</option>
                            <option>DI57</option>
                            <option>DI58</option>
                            <option>DI59</option>
                            <option>DI60</option>
                            <option>DI61</option>
                            <option>DI62</option>
                            <option>DI63</option>
                            <option>DI64</option>
                            <option>DI65</option>
                            <option>DI66</option>
                            <option>DI67</option>
                            <option>DI68</option>
                            <option>DI69</option>
                            <option>DI70</option>
                            <option>DI71</option>
                            <option>DI72</option>
                            <option>TP1</option>
                            <option>TP2</option>



                           
                        </select>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="price">Price *</label>
                        <input type="money" name="price" required class="form-control" />
                    </div>               
                    <div class="col-md-12 mb-4 text-end">
                        <button type="submit" name="save_menu" class="btn btn-success">Add Item</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>
