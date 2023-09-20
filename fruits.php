<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Price List</title>
    <style>
        /* Table styling */
        /* Table styling */
.container {
    max-width: 1000px;
    margin-left: auto;
    margin-right: auto;
    padding-left: 10px;
    padding-right: 10px;
}

.page-section {
    display: flex;
    justify-content: center;
    align-items: center;
}

.responsive-table {
    list-style: none;
    padding: 0;
}

.table-header {
    background-color: #95A5A6;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.03em;
    display: flex;
    justify-content: space-between;
    border-radius: 3px;
    padding: 15px 20px; /* Adjust padding here */
    margin-bottom: 15px; /* Adjust margin here */
}

.table-row {
    background-color: #ffffff;
    box-shadow: 0px 0px 9px 0px rgba(0, 0, 0, 0.1);
    border-radius: 3px;
    padding: 15px 20px; /* Adjust padding here */
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px; /* Adjust margin here */
}

.col-1 {
    flex-basis: 10%;
}

.col-2 {
    flex-basis: 15%; /* Adjust flex-basis for Product Name */
}

.col-3 {
    flex-basis: 15%; /* Adjust flex-basis for Unit */
}

.col-4 {
    flex-basis: 20%; /* Adjust flex-basis for Market Price */
}

.col-5 {
    flex-basis: 20%; /* Adjust flex-basis for Retail Price */
}

.col-6 {
    flex-basis: 20%; /* Adjust flex-basis for Shopping Mall */
}

@media all and (max-width: 767px) {
    .table-header {
        display: none;
    }

    .table-row {
        flex-wrap: wrap;
    }

    .col-1,
    .col-2,
    .col-3,
    .col-4,
    .col-5,
    .col-6 {
        flex-basis: 100%;
    }

    .col-1::before,
    .col-2::before,
    .col-3::before,
    .col-4::before,
    .col-5::before,
    .col-6::before {
        color: #6C7A89;
        padding-right: 10px;
        content: attr(data-label);
        flex-basis: 50%;
        text-align: right;
    }
}

    </style>
</head>

<body>
    <!-- Price List Section -->
    <div class="container">
        <center>
            <h2><i class="bx bx-money"></i> Demand</h2>
        </center>
        <br><br>
        <ul class="responsive-table" id="marketTable">
            <li class="table-header">
                <div class="col col-1">S.No</div>
                <div class="col col-2">Product Name</div>
                <div class="col col-3">Unit</div>
                <div class="col col-4">Market Price</div>
                <div class="col col-5">Retail Price</div>
                <div class="col col-6">Shopping Mall</div>
            </li>
        </ul>
        <center>
            <h8 style="color:red;">*Please note that above shown content in the table is just a prediction made by our team</h8>
        </center>
    </div>
    <br><br>

    <script>
        // Replace this URL with the actual URL of your JSON file
        const jsonUrl = "https://api-bid.pages.dev/fruits_data.json";

        // Fetch JSON data from the URL
        fetch(jsonUrl)
            .then(response => response.json())
            .then(data => {
                const table = document.getElementById("marketTable");
                let serialNumber = 1; // Initialize serial number

                // Loop through the JSON data and create rows for the table
                data.forEach(product => {
                    const row = document.createElement("li");
                    row.classList.add("table-row");

                    const snoCell = document.createElement("div");
                    snoCell.classList.add("col", "col-1");
                    snoCell.setAttribute("data-label", "S.No");
                    snoCell.textContent = serialNumber;

                    const nameCell = document.createElement("div");
                    nameCell.classList.add("col", "col-2");
                    nameCell.setAttribute("data-label", "Product Name");
                    nameCell.textContent = product.Name;

                    const unitCell = document.createElement("div");
                    unitCell.classList.add("col", "col-3");
                    unitCell.setAttribute("data-label", "Unit");
                    unitCell.textContent = product.Unit;

                    const marketPriceCell = document.createElement("div");
                    marketPriceCell.classList.add("col", "col-4");
                    marketPriceCell.setAttribute("data-label", "Market Price");
                    marketPriceCell.textContent = product["Market Price"];

                    const retailPriceCell = document.createElement("div");
                    retailPriceCell.classList.add("col", "col-5");
                    retailPriceCell.setAttribute("data-label", "Retail Price");
                    retailPriceCell.textContent = product["Retail Price"];

                    const shoppingMallCell = document.createElement("div");
                    shoppingMallCell.classList.add("col", "col-6");
                    shoppingMallCell.setAttribute("data-label", "Shopping Mall");
                    shoppingMallCell.textContent = product["Shopping Mall"];

                    row.appendChild(snoCell);
                    row.appendChild(nameCell);
                    row.appendChild(unitCell);
                    row.appendChild(marketPriceCell);
                    row.appendChild(retailPriceCell);
                    row.appendChild(shoppingMallCell);

                    table.appendChild(row);

                    // Increment the serial number for the next product
                    serialNumber++;
                });
            })
            .catch(error => {
                console.error("Error fetching data:", error);
            });
    </script>
</body>

</html>
