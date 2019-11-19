<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title><?php page_title(); ?></title>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link href="<?php site_url(); ?>/templates/style.css" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">


    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>


<div class="container">

    <?php
    $list = get_list_array();
    $envelope_price = -1;
    $xxl_price = -1;
    $premium_price = -1;
    $xl_price = -1;
    setlocale(LC_MONETARY, 'nl_NL.UTF-8');

    ?>
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-body">

                    <div class="dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            Choose the price
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:void(0)" data-type="1">Normal</a>
                            <a class="dropdown-item" href="javascript:void(0)" data-type="2">XXL</a>
                            <a class="dropdown-item" href="javascript:void(0)" data-type="3">Envelope</a>
                            <a class="dropdown-item" href="javascript:void(0)" data-type="4">Premium</a>
                            <a class="dropdown-item" href="javascript:void(0)" data-type="5">XL</a>
                        </div>
                    </div>

                </div>
            </div>


        </div>
        <div class="col-12">

            <div class="card">

                <div class="card-body">


                    <table class="table" id="list-table">
                        <thead>
                        <tr>
                            <th scope="col">Thumbnail</th>
                            <th scope="col">Title</th>
                            <th scope="col">Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $row_number = 0;
                        $row_class = "";
                        foreach ($list as $row) :?>

                            <?php $row_class = $row_number == 3 ? "special-row" : ""; ?>

                            <tr class="<?php echo $row_class ?>" data-id="<?php echo $row->id; ?>" data-price="<?php echo $row->price; ?>">
                                <td class="img-cell" data-src="<?php echo $row->thumb_url; ?>">
                                    <?php if($row_number % 2 == 0): ?>
                                        <div class="spinner-border text-danger"></div>
                                    <?php else: ?>
                                        <div class="spinner-border text-warning"></div>
                                    <?php endif ?>
                                </td>
                                <td><?php echo $row->title ?></td>
                                <?php if ($envelope_price == -1): ?>
                                    <?php
                                    $envelope_price = get_add_on_prices($row->id)[1];
                                    $xxl_price = get_add_on_prices($row->id)[0];
                                    $premium_price = get_add_on_prices($row->id)[2];
                                    $xl_price = get_add_on_prices($row->id)[3];
                                    ?>
                                <?php endif ?>
                                <?php
                                $price = $row->price + $envelope_price;

                                ?>
                                <td class="price-cell" data-price="<?php echo $price ?>">
                                </td>
                            </tr>
                            <?php $row_number++; ?>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>

            </div>


        </div>
    </div>


    <div id="add-on-prices">
        <input type="hidden" value="<?php echo $xxl_price; ?>" id="xxl-price"/>
        <input type="hidden" value="<?php echo $envelope_price; ?>" id="envelope-price"/>
        <input type="hidden" value="<?php echo $premium_price; ?>" id="premium-price"/>
        <input type="hidden" value="<?php echo $xl_price; ?>" id="xl-price"/>
    </div>

</div>

<footer>
    <small>&copy;<?php echo date('Y'); ?> <?php page_title(); ?>.<br><?php site_version(); ?></small>
</footer>


<script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

<script src="<?php site_url(); ?>/templates/accounting.js"></script>
<script src="<?php site_url(); ?>/templates/index.js"></script>


</body>
</html>