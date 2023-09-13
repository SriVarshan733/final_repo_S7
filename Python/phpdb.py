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