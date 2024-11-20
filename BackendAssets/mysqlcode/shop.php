
<?php
include("../../config/db.php");
header('Content-Type: application/json');

if(isset($_POST['action']) && $_POST['action'] === 'fetch_all_products')
{
    $output='';
    $filter=$_POST['filter'];
    $value=strval($_POST['value']);
    $query=$conn->prepare("SELECT * FROM `products` WHERE category=?");
    $query->bind_param('s',$value);
    if($query->execute())
    {
        $result=$query->get_result();
        $products=$result->fetch_all(MYSQLI_ASSOC);
        if((int)count($products) !== 0)
        {
            foreach($products as $pro)
            {
                $output.="<div class='col-sm-3'>
                <div class='productCard text-center'>
                        <a href='".BASE_URL."singleProduct/".urlencode($pro['category'])."/".$pro['id']."' target='_blank' rel='noopener noreferrer'>
                            <img src='".BASE_URL.'BackendAssets/assets/images/ProductImages/'.$pro['productimage']."'>
                        </a>
                        <h6>".$pro['productname']."</h6>
                        <h6>".$pro['price']."</h6>
                        <button class='add-to-cart-btn' product_cart_id='".$pro['id']."'>
                        Add to cart
                        <span style='padding: 0 5px;'><i class='fa fa-shopping-bag' aria-hidden='true'></i></span>
                        </button>
                </div>
                </div>
                ";
            }
        }
        else
        {
            $output="<h4>No product found</h4>";
        }
        echo json_encode(["status"=>true,"data"=>$output]);
    }
}
else
{
    echo json_encode(["status"=>false]);
}

?>