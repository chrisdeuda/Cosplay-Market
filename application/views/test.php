<html>
	<head>

	</head>
	<body>
            <ul>
                <?php foreach($item_list as $row): ?>
                <li><?=$row->USER_ID?></li>
                <?php endforeach;?>
                
                <?php
                echo "<pre>";
                print_r( $item_list);
                echo "</pre>";
                
                
                
                
                ?>
                
                
                
                
            </ul>
                   
            
            
            
       
		



	</body>
</html>