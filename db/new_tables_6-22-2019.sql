
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` datetime NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;



CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `people_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `emp_no` varchar(255) NOT NULL,
  `SSS` varchar(255) NOT NULL,
  `PAGIBIG` varchar(255) NOT NULL,
  `TIN` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);
COMMIT;



CREATE TABLE `people` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `people`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `people`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;



CREATE TABLE `stock_movement` (
  `id` int(11) NOT NULL,
  `refcode` varchar(255) NOT NULL,
  `movement_date` date NOT NULL,
  `source_id` int(11) NOT NULL,
  `source_type` varchar(255) NOT NULL COMMENT 'Branch or Supplier',
  `type` varchar(255) NOT NULL COMMENT 'Inbound, Outbound, Orders, Returns',
  `dr_docs` varchar(255) NOT NULL,
  `destination_type` varchar(255) NOT NULL COMMENT 'Branch or Supplier',
  `destination` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `stock_movement`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `stock_movement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

CREATE TABLE `stock_movement_items` (
  `id` int(11) NOT NULL,
  `movement_id` int(11) NOT NULL,
  `destination_id` int(11) NOT NULL,
  `price_start` double NOT NULL,
  `selling_price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `batch_number` int(11) NOT NULL,
  `exp_date` datetime NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `stock_movement_items`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `stock_movement_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

CREATE TABLE `stock_movement_personnel` (
  `id` int(11) NOT NULL,
  `movement_id` int(11) NOT NULL,
  `people_id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `stock_movement_personnel`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `stock_movement_personnel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;


CREATE TABLE `stock_movement_vehicles` (
  `id` int(11) NOT NULL,
  `movement_id` int(11) NOT NULL,
  `plate_number` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `stock_movement_vehicles`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `stock_movement_vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;


CREATE TABLE `item_images` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `item_images`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `item_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

CREATE TABLE `item_variations` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `color` varchar(255) NOT NULL,
  `size` varchar(200) NOT NULL COMMENT 'Samall (s) , Medium (m) , Large (l) etc etc',
  `length` double NOT NULL,
  `width` double NOT NULL,
  `height` double NOT NULL,
  `weight` double NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `item_variations`
  ADD PRIMARY KEY (`id`);
COMMIT;