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
                                    <h2>Categories</h2>
                                    <p>Welcome to Notika <span class="bread-ntd">Admin Template</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                            <div class="breadcomb-report">
                                <!-- <a href="#">Create category</a> -->
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
                        <h2><?= isset($category->id) ? 'Update ' . $category->name . ' category' : 'Create a new category' ?></h2>
                    </div>
                    <form onsubmit="submitForm(this); return false;" action="<?= isset($category->id) ? url('category&action=update&id=' . $category->id) : url('category&action=store') ?>" method="post">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-example-int form-example-st">
                                    <div class="form-group">
                                        <div class="nk-int-st">
                                            <input type="text" name="name" id="name" value="<?= isset($category->id) ? $category->name : '' ?>" class="form-control input-sm" placeholder="Enter Name">
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
                                            <input type="text" name="description" id="description" value="<?= isset($category->id) ? $category->description : '' ?>" class="form-control input-sm" placeholder="Enter Description">
                                        </div>
                                        <?php $error = flash('description');
                                        if (isset($error['description'])) : ?>
                                            <span style="color: red;"><?= $error['description'] ?></span>
                                        <?php endif; ?>
                                        <div id="descriptionerror" style="color: red;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="chosen-select-act fm-cmp-mg">
                                    <select class="chosen" name="products[]" id="products" multiple data-placeholder="Choose a Products...">
                                        <?php foreach ($products as $product) : ?>
                                            <option value="<?= $product->id ?>"><?= $product->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-example-int">
                                    <input type="hidden" name="update_key" value="0">
                                    <button type="submit" class="btn btn-success notika-btn-success"><?= isset($category->id) ? 'Update' : 'Submit' ?></button>
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
                                    <th>Description</th>
                                    <th>Products</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($categories)) :
                                    foreach ($categories as $category) :
                                ?>
                                        <tr>
                                            <td><?= htmlspecialchars($category->id) ?></td>
                                            <td><?= htmlspecialchars($category->name) ?></td>
                                            <td><?= htmlspecialchars($category->description) ?></td>
                                            <td><?= htmlspecialchars($category->product[0]->name ?? 'No Product') ?></td>
                                            <td>
                                                <button onclick="ajaxLoad('<?= url("category&action=edit&id=$category->id") ?>', <?= $category->id ?>)" data-id="<?= $category->id ?>" class="btn btn-info btn-sm">Edit</button>
                                                <button onclick="ajaxLoad('<?= url("category&action=destroy&id=$category->id") ?>', <?= $category->id ?>)" data-id="<?= $category->id ?>" class="btn btn-danger btn-sm">Delete</button>
                                            </td>
                                        </tr>
                                <?php endforeach;
                                endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Products</th>
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