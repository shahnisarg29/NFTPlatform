1.User Registration

Traders table insert;----done

2.Login page---done

3.a Display NFT for buying (Home page)

SELECT name,
current_mp, 
(select CONCAT(first_name,' ',last_name) from traders t
 where t.client_id=nfti.owner_id) OwnerName ,
token_id,
owner_id
from nft_items nfti where list=1 and owner_id <> $client_idfromsession;


3.b To display his all NFTs 

SELECT name,
current_mp,
list, 
token_id,
owner_id
from nft_items nfti where  owner_id = $client_idfromsession;


3.c User wants to List NFT---to sell/list by trader

update nft_items set list=1 where owner_id='$owner_idfromsession' 
and token_id='token_idfromsession';


4. When user clicks on Buy button of some NFT 

var client_category=
select client_category from traders where client_id=?sessionid;

var smart_contract_add=select smart_contract_address from nft_items
 where token_id=?nft_token_idfromsession;

 var seller_eth_address=select ethereum_address from traders t
 where t.client_id=$owner_idfromsession;

 var buyer_eth_address=select ethereum_address from traders t
 where t.client_id=$client_idfromsession;

Insert into nft_transaction (transaction_date,commission,commission_type,
	nft_address,nft_token_id,
                            seller_eth_address,buyer_eth_address,
                            transaction_status,amount,commission_payment_in,
                            eth_count) VALUES
(now(),?,'$client_category','$smart_contract_add'
	,?nft_token_idfromsession,'$seller_eth_address'
 ,'$buyer_eth_address','success',$current_mpfromsession,'USD',NULL
);

---if success payment---
update nft_items set owner_id='$clientidfromsession',list=0 
	where owner_id='$owner_idfromsession' 
	and 
	token_id=$tokenidfromsession;

--change in amount of user--

-----------------------For buyer-----------------------
update traders set eth_count=eth_count-? where client_id=$clientidfromsession;
update traders set balance=balance-?	where client_id=$clientidfromsession;

--------------------------For seller-----------------------
update traders set eth_count=eth_count+? where client_idfromsession=$owner_idfromsession;
update traders set balance=balance+?	where client_id=$owner_idfromsession;


5. When user adds new Payment to wallet

-- for USD--

Insert into payment_transaction (client_id,payment_type,transaction_date,
	amount,payment_address,status,eth_count)
VALUES
(?,'USD',now(),?,'?','success',NULL);


update traders set balance=balance+$amountfromsession where client_id
	=$clientidfromsession;

--for ethereum--
var ethereum_address= select ethereum_address from traders 
where client_id = "client_idfromsession"

Insert into payment_transaction 
(client_id,payment_type,transaction_date,amount,payment_address,status,eth_count)
VALUES
(?,'ETH',now(),NULL,'$ethereum_address','success',?);


update traders set balance=balance+$amountfromsession where client_id
	=$clientidfromsession;


6. Cancel transaction


----For NFT Transaction cancellation check on button click

select 'Yes' from nft_transaction
where transaction_status='success' 
and transaction_date >= current_timestamp() - interval 15 minute 
and transaction_date <= current_timestamp()
and buyer_eth_address= (select ethereum_address from traders where client_id=
$clientidfromsession);

-----if nothing returns then
--popup message

-----else

update nft_transaction set status='cancelled' 
	where  transaction_id=$fromsession;

	-----------------------For seller-----------------------
update traders set eth_count=eth_count-? where 
	ethereum_address=(select seller_eth_address from nft_transaction where
		transaction_id=$fromsession);
update traders set balance=balance-?	where 
	ethereum_address=(select seller_eth_address from nft_transaction where
		transaction_id=$fromsession);
--------------------------For buyer-----------------------
update traders set eth_count=eth_count+? where 
	ethereum_address=(select buyer_eth_address from nft_transaction where
		transaction_id=$fromsession);
update traders set balance=balance+?	where 
	ethereum_address=(select buyer_eth_address from nft_transaction where
		transaction_id=$fromsession);

7. Cancel payment 

select * from payment_transaction
where status='success' 
and transaction_date >= current_timestamp() - interval 15 minute 
and transaction_date <= current_timestamp()
and payment_id= $clientidfromsession;

----For Payment Transaction cancellation check on button click

update payment_transaction set status='cancelled' 
	where  payment_id=$fromsessionpayment;

 update traders set balace=balance-? where
 	client_id=$clientidfromsession;

8. To add new NFT

Insert into nft_items (smart_contract_address, name, current_mp,owner_id, list) 
values ($fromsession, $namefromsession, $fromapi, $fromsession, 0);


9. Transaction History

select nft.transaction_date, nft.transaction_id
(select name from nft_items nfti where nfti.token_id=nft.nft_token_id) TokenName,
nft.transaction_status, nft.amount, nft.commision_payment_in,nft.eth_count
where buyer_eth_address= (select ethereum_address from traders where client_id=
$clientidfromsession
) order by nft.transaction_date desc;



10. Payment History
select p.transaction_date,p.payment_id
p.payment_type,p.amount,p.eth_count,p.payment_address,p.status
from payment_transaction p
where p.client_id=$clientidfromsession order by p.transaction_date desc;


11. Manager view created manager_view


