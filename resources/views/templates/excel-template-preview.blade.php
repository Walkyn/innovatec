<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Plantilla Excel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: #f5f5f5;
        }
        .excel-preview {
            background: white;
            border: 1px solid #ccc;
            border-radius: 4px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        th {
            background: #f0f0f0;
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            font-weight: bold;
        }
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .example-row {
            background: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="excel-preview">
        <table>
            <thead>
                <tr>
                    <th>APELLIDOS Y NOMBRES</th>
                    <th>DNI</th>
                    <th>DIRECCION O REFERENCIA</th>
                    <th>PLAN CONTRATADO</th>
                    <th>FECHA DE INST.</th>
                    <th>N° CELULAR</th>
                </tr>
            </thead>
            <tbody>
                <tr class="example-row">
                    <td>ANACELI RUIZ CORONEL</td>
                    <td>23529183</td>
                    <td>ALUMNA DE ROOSEVELT</td>
                    <td>PLAN DE 50</td>
                    <td>06/07/22</td>
                    <td>929 015 049</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html> 