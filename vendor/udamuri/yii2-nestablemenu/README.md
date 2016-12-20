README
======
Yii2 nestablemenu using jquery.nestable plugin.
- jquery.nestable plugin: http://dbushell.github.io/Nestable/

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist udamuri/yii2-nestablemenu "*"
```

or add

```
"udamuri/yii2-nestablemenu": "*"
```
to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \udamuri\nestablemenu\TreeMenu::widget([
	    		'table_name'=>'nestamenu',
	    		'containerID' => 'nesta-menu',
	    		'output' => 'show', //hidden
	    		'delete_url' => 'site/delete-menu/1',
	    		'update_url' => 'site/update-menu/1',
	    		'button' => [
	    			'save' => [
	    				'id' => 'save-change',
	    				'label' => 'Save Change',
	    				'btn-class' => 'btn-primary',
	    				'url' => 'site/sort-menu/1'
	    			],
	    			'add' => [
	    				'id' => 'add-new',
	    				'label' => 'Add New',
	    				'btn-class' => 'btn-success',
	    				'url' => 'site/add-new'
	    			],
	    		],
	    	]); 
	    ?>
```

Table structure for table `nestamenu`
-----
```SQL
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
-- --------------------------------------------------------

CREATE TABLE `nestamenu` (
  `menu_id` int(3) NOT NULL,
  `menu_parent_id` int(3) DEFAULT NULL,
  `menu_sort` int(3) DEFAULT NULL,
  `menu_title` varchar(100) DEFAULT NULL,
  `menu_link` varchar(255) DEFAULT NULL,
  `menu_status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nestamenu`
--

INSERT INTO `nestamenu` (`menu_id`, `menu_parent_id`, `menu_sort`, `menu_title`, `menu_link`, `menu_status`) VALUES
(1, 0, 1, 'Home', 'empty', 1),
(2, 0, 2, 'Perfectplaces', 'empty', 1),
(3, 2, 3, 'Lakerentals', 'empty', 1),
(4, 2, 4, 'Mountainskirentals', 'empty', 1),
(5, 0, 5, 'Redawning', 'empty', 1),
(6, 5, 6, 'Booking', 'empty', 1),
(7, 4, 7, 'Jakarta', 'empty', 1),
(8, 6, 8, 'Medan', 'empty', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nestamenu`
--
ALTER TABLE `nestamenu`
  ADD PRIMARY KEY (`menu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nestamenu`
--
ALTER TABLE `nestamenu`
  MODIFY `menu_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

```

![alt tag](https://github.com/udamuri/yii2-nestablemenu/blob/master/img.jpg)