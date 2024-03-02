create VIEW view_transaction_details as
SELECT 
	transaction_details.id, 
	transaction_details.transaction_id, 
	transaction_details.product_id, 
	transaction_details.amount, 
	products.price ,
	transaction_details.amount * products.price as 'total'
FROM transaction_details
JOIN products on products.id = transaction_details.product_id;


create VIEW view_transactions as
SELECT 
	transactions.id,
    transactions.date,
    transactions.owner_id,
    transactions.product_link_id,
    transactions.type,
    (SELECT CEIL(product_links.amount) FROM product_links WHERE product_links.id = transactions.product_link_id) as 'modify',
    (SELECT CEIL(sum(view_transaction_details.total)) FROM view_transaction_details WHERE view_transaction_details.transaction_id = transactions.id) as 'repair',
    CEIL(transactions.reimbursement),
    CEIL(transactions.bonus),
    CASE 
        WHEN  transactions.`type` = 'modif'  THEN   (SELECT CEIL(product_links.amount) FROM product_links WHERE product_links.id = transactions.product_link_id) * 0.086 
        WHEN  transactions.`type` = 'repair'  THEN   (SELECT CEIL(sum(view_transaction_details.total)) FROM view_transaction_details WHERE view_transaction_details.transaction_id = transactions.id)
        WHEN  transactions.`type` = 'reimburse'  THEN  0
        WHEN  transactions.`type` = 'bonus'  THEN   CEIL(transactions.bonus)
    END as 'fee',
    CASE 
        WHEN  transactions.`type` = 'modif'  THEN   (SELECT CEIL(product_links.amount) FROM product_links WHERE product_links.id = transactions.product_link_id) * 0.86 
        WHEN  transactions.`type` = 'repair'  THEN   0
        WHEN  transactions.`type` = 'reimburse'  THEN  CEIL(transactions.reimbursement)
        WHEN  transactions.`type` = 'bonus'  THEN   0
    END as 'reimburse',
    transactions.created_at,
    transactions.updated_at
FROM transactions;




-- update price transaction_details
UPDATE transaction_details  SET price = (SELECT price FROM products WHERE products.id = transaction_details.product_id)

-- update total transaction_details
UPDATE transaction_details  SET total = amount* price

-- update modif transactions
UPDATE transactions set modif = (SELECT amount from product_links WHERE product_links.id = transactions.product_link_id)

-- update repair transactions
UPDATE transactions set repair = (SELECT SUM(total) from transaction_details WHERE transaction_details.transaction_id = transactions.id)

-- update fee transactions
UPDATE transactions  SET fee = CASE 
	WHEN  transactions.`type` = 'modif'  THEN    transactions.modif * 0.086
    WHEN  transactions.`type` = 'repair'  THEN    transactions.repair
	ELSE    transactions.bonus
END     

-- update reimburse transactions
UPDATE transactions  SET reimburse = CASE 
	WHEN  transactions.`type` ='modif'  THEN    transactions.modif *0.86
	ELSE   transactions.reimbursement
END