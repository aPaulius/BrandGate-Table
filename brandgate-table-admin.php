<?php
        // check if database settings form is submitted
        if ($_POST['bct_hidden'] == 'database_true') {

            // handle settings data
            $dbhost = $_POST['bct_dbhost'];
            update_option('bct_dbhost', $dbhost);

            $dbname = $_POST['bct_dbname'];
            update_option('bct_dbname', $dbname);

            $dbuser = $_POST['bct_dbuser'];
            update_option('bct_dbuser', $dbuser);

            $dbpassword = $_POST['bct_dbpassword'];
            update_option('bct_dbpassword', $dbpassword);

            // create databse table
            bct_create_table('BrandGate'); ?>

            <div class="updated"><p><strong><?php _e('Settings saved.' ); ?></strong></p></div>

        <?php }

        // check if table form is submitted
        elseif ($_POST['bct_hidden'] == 'table_true') {

            // handle table data
            $name = $_POST['bct_name'];
            update_option('bct_name', $name);

            $value = $_POST['bct_value'];
            update_option('bct_value', $value);

            // insert data to database
            bct_insert_data('BrandGate', $name, $value); ?>

            <div class="updated"><p><strong><?php _e('Data inserted.' ); ?></strong></p></div>

        <?php } else { ?>
        <div class="wrap">
            <?php echo "<h2>" . __( 'BrandGate Table Options', 'bct_trdom') . "</h2>";

            $dbhost = get_option('bct_dbhost');
            $dbname = get_option('bct_dbname');
            $dbuser = get_option('bct_dbuser');
            $dbpassword = get_option('bct_dbpassword');

            ?>

            <form name="bct_form_database" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
                <input type="hidden" name="bct_hidden" value="database_true">
                <?php    echo "<h4>" . __( 'Database Settings', 'bct_trdom' ) . "</h4>"; ?>
                <p><?php _e("Database host: " ); ?><input type="text" name="bct_dbhost" value="<?php echo $dbhost; ?>" size="20"><?php _e(" ex: localhost" ); ?></p>
                <p><?php _e("Database name: " ); ?><input type="text" name="bct_dbname" value="<?php echo $dbname; ?>" size="20"><?php _e(" ex: test_shop" ); ?></p>
                <p><?php _e("Database user: " ); ?><input type="text" name="bct_dbuser" value="<?php echo $dbuser; ?>" size="20"><?php _e(" ex: root" ); ?></p>
                <p><?php _e("Database password: " ); ?><input type="text" name="bct_dbpassword" value="<?php echo $dbpassword; ?>" size="20"><?php _e(" ex: secretpassword" ); ?></p>

                <p class="submit">
                <input type="submit" name="Submit" value="<?php _e('Update Settings', 'bct_trdom' ) ?>" />
                </p>
            </form>

            <hr>

            <form name="bct_form_table" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
                <input type="hidden" name="bct_hidden" value="table_true">
                <?php    echo "<h4>" . __( 'Insert Data into BrangGate Table', 'bct_trdom' ) . "</h4>"; ?>

                <p><?php _e("Name: " ); ?><input type="text" name="bct_name" value="<?php echo $name; ?>" size="20"><?php _e(" ex: Paulius" ); ?></p>
                <p><?php _e("Value: " ); ?><input type="number" name="bct_value" value="<?php echo $value; ?>" size="20"><?php _e(" ex: 123" ); ?></p>

                <p class="submit">
                <input type="submit" name="Submit" value="<?php _e('Insert Data', 'bct_trdom' ) ?>" />
                </p>
            </form>

        </div>
    <?php } ?>
