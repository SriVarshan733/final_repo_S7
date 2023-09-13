import mysql.connector
from datetime import datetime

# Replace these with your database connection details
host = "database-1.cwa1v3hdvy5b.us-east-1.rds.amazonaws.com"
user = "admin"
password = "admin123"
database = "kk"


def connect():
    try:
        connection = mysql.connector.connect(
            host=host, user=user, password=password, database=database)
        if connection.is_connected():
            print("Db Connected ")
            return connection
    except mysql.connector.Error as e:
        print("Error:", e)


def getListOfProductId(conn):
    cursor = conn.cursor()
    query = "SELECT DISTINCT product_id FROM bids"
    cursor.execute(query)
    results = cursor.fetchall()
    return [product[0] for product in results]


def checkChangeTheStatus(conn, listOfProductId):
    cursor = conn.cursor()

    for product_id in listOfProductId:
        # Get the highest bid_amount for the product_id
        highest_bid_query = f"SELECT MAX(bid_amount) FROM bids WHERE product_id = {product_id}"
        cursor.execute(highest_bid_query)
        highest_bid = cursor.fetchone()[0]

        # Update the status to 2 only for the highest bid_amount
        update_query = f"UPDATE bids SET status = 2 WHERE product_id = {product_id} AND bid_amount = {highest_bid}"
        cursor.execute(update_query)
        conn.commit()

    print("Data Updated Successfully.")


connection = connect()
listOfProductId = getListOfProductId(connection)
checkChangeTheStatus(connection, listOfProductId)

def getListOfProductId(conn):
    cursor = conn.cursor()
    query = "SELECT DISTINCT product_id FROM bids WHERE status = 2"
    cursor.execute(query)
    results = cursor.fetchall()
    return [product[0] for product in results]


def updateProductTable(conn, product_id, buyer_id, bid_amt):
    cursor = conn.cursor()
    
    # Update the product table with buyer_id and bid_amt
    update_query = f"UPDATE products SET buyer_id = {buyer_id}, bid_amt = {bid_amt} WHERE id = {product_id}"
    cursor.execute(update_query)
    conn.commit()
    
    print(f"Updated product ID {product_id} with buyer_id {buyer_id} and bid_amt {bid_amt}.")


def checkChangeTheStatus(conn, listOfProductId):
    cursor = conn.cursor()

    for product_id in listOfProductId:
        # Get the highest bid_amount for the product_id
        highest_bid_query = f"SELECT MAX(bid_amount) FROM bids WHERE product_id = {product_id}"
        cursor.execute(highest_bid_query)
        highest_bid = cursor.fetchone()[0]

        # Update the status to 2 only for the highest bid_amount
        update_query = f"UPDATE bids SET status = 2 WHERE product_id = {product_id} AND bid_amount = {highest_bid}"
        cursor.execute(update_query)
        conn.commit()
        
        # Get the buyer_id for the highest bid
        buyer_id_query = f"SELECT user_id FROM bids WHERE product_id = {product_id} AND bid_amount = {highest_bid}"
        cursor.execute(buyer_id_query)
        buyer_id = cursor.fetchone()[0]
        
        # Update the product table with buyer_id and bid_amt
        updateProductTable(conn, product_id, buyer_id, highest_bid)

    print("Data Updated Successfully.")


connection = connect()
listOfProductId = getListOfProductId(connection)
checkChangeTheStatus(connection, listOfProductId)
