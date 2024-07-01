<div class="breadcomb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcomb-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcomb-wp">
                                <div class="breadcomb-icon">
                                    <i class="notika-icon notika-windows"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>Products</h2>
                                    <p>Welcome to Notika <span class="bread-ntd">Admin Template</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                            <div class="breadcomb-report">
                                <!-- <a href="#">Create Product</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-example-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-example-wrap mg-t-30">
                    <div class="cmp-tb-hd cmp-int-hd">
                        <h2><?= isset($product->id) ? 'Update ' . $product->name . ' product' : 'Create a new product' ?></h2>
                    </div>
                    <form onsubmit="submitForm(this); return false;" action="<?= isset($product->id) ? url('product&action=update&id=' . $product->id) : url('product&action=store') ?>" method="post">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-example-int form-example-st">
                                    <div class="form-group">
                                        <div class="nk-int-st">
                                            <input type="text" name="name" id="name" value="<?= isset($product->id) ? $product->name : '' ?>" class="form-control input-sm" placeholder="Enter Name">
                                        </div>
                                        <?php $error = flash('name');
                                        if (isset($error['name'])) : ?>
                                            <span style="color: red;"><?= $error['name'] ?></span>
                                        <?php endif; ?>
                                        <div id="nameerror" style="color: red;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-example-int form-example-st">
                                    <div class="form-group">
                                        <div class="nk-int-st">
                                            <input type="text" name="price" id="price" value="<?= isset($product->id) ? $product->price : '' ?>" class="form-control input-sm" placeholder="Enter Price">
                                        </div>
                                        <?php $error = flash('price');
                                        if (isset($error['price'])) : ?>
                                            <span style="color: red;"><?= $error['price'] ?></span>
                                        <?php endif; ?>
                                        <div id="priceerror" style="color: red;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-example-int">
                                    <input type="hidden" name="update_key" value="0">
                                    <button type="submit" class="btn btn-success notika-btn-success"><?= isset($product->id) ? 'Update' : 'Submit' ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <div class="basic-tb-hd">
                        <?php
                        $success = flash('success');
                        if ($success) {
                            echo '<div class="alert alert-success">' . $success . '</div>';
                        }
                        ?>
                    </div>
                    <div id="datarecords" class="table-responsive">
                        <table id="data-table-basic" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($products)) :
                                    foreach ($products as $product) :
                                ?>
                                        <tr>
                                            <td><?= htmlspecialchars($product->id) ?></td>
                                            <td><?= htmlspecialchars($product->name) ?></td>
                                            <td><?= htmlspecialchars($product->price) ?></td>
                                            <td>
                                                <?php
                                                if ($product->status == 0) {
                                                    echo "<a href='javascript:;' class='badge btn-danger' onclick=\"statusChange('" . url('product&action=status&id=' . $product->id . '&status=' . $product->status) . "', " . $product->id . ")\" data-id=\"" . $product->id . "\">in Active</a>";
                                                } else {
                                                    echo "<a href='javascript:;' class='badge btn-success' onclick=\"statusChange('" . url('product&action=status&id=' . $product->id . '&status=' . $product->status) . "', " . $product->id . ")\" data-id=\"" . $product->id . "\">Active</a>";
                                                }
                                                ?>

                                            </td>
                                            <td>
                                                <!-- <a href="index?page=user&action=show&id=<?= $user->id ?>">View</a> -->
                                                <button onclick="ajaxLoad('<?= url("product&action=edit&id=$product->id") ?>', <?= $product->id ?>)" data-id="<?= $product->id ?>" class="btn btn-info btn-sm">Edit</button>
                                                <button onclick="ajaxLoad('<?= url("product&action=destroy&id=$product->id") ?>', <?= $product->id ?>)" data-id="<?= $product->id ?>" class="btn btn-danger btn-sm">Delete</button>
                                            </td>
                                        </tr>
                                <?php endforeach;
                                endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>status</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
