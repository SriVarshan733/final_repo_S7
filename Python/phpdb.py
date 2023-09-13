import mysql.connector
from datetime import datetime

# Replace these with your database connection details
host = "localhost"
user = "root"
password = ""
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
    query = "SELECT DISTINCT product_id FROM bids WHERE status = 2"
    cursor.execute(query)
    results = cursor.fetchall()
    return [product[0] for product in results]

def updateProductsTable(conn, product_id, buyer_id, bid_amt):
    cursor = conn.cursor()
    update_query = f"UPDATE products SET buyer_id = {buyer_id}, bid_amt = {bid_amt} WHERE id = {product_id}"
    cursor.execute(update_query)
    conn.commit()

def checkChangeTheStatus(conn, listOfProductId):
    cursor = conn.cursor()

    for product_id in listOfProductId:
        # Get the highest bid_amount and buyer_id for the product_id where status = 2
        highest_bid_query = f"SELECT MAX(bid_amount), user_id FROM bids WHERE product_id = {product_id} AND status = 2"
        cursor.execute(highest_bid_query)
        result = cursor.fetchone()
        
        if result:
            highest_bid, buyer_id = result
            updateProductsTable(conn, product_id, buyer_id, highest_bid)
            print(f"Updated product {product_id}: buyer_id={buyer_id}, bid_amt={highest_bid}")
        else:
            print(f"No valid bid found for product {product_id}")

    print("Data Updated Successfully.")

connection = connect()
listOfProductId = getListOfProductId(connection)
checkChangeTheStatus(connection, listOfProductId)
