<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirmation de la commande</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        th {
            text-align: left;
        }

        .total {
            font-weight: bold;
        }

        .produit {
            height: 70px !important;
            height: 70px !important;
            border-radius: 10px;
            overflow: hidden;
        }

        .produit img {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Order Confirmation</h2>
        <p>Hello {{ $commande->prenom ?? "" }} {{ $commande->nom }},</p>
        <p>We've received your order. Here are the details:</p>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php
                    //  $frais_livraison = $config->frais_livraison ?? 0;
                
                  $config = DB::table('configs')->first();
                 $frais_livraison = $config->frais ?? 0;
                    $total = $frais_livraison;
                   // dd($frais_livraison);
                @endphp
                @foreach ($commande->contenus as $item)
                    <tr>
                        <td>
                            <div class="produit">
                                <img src="{{ url(Storage::url($item->produit->photo)) }}" alt="{{ $item->produit->nom }}"
                                    srcset="">
                            </div>
                        </td>
                        <td>{{ $item->produit->nom }}</td>
                        <td>{{ $item->prix_unitaire }} DT</td>
                        <td>{{ $item->quantite }}</td>
                        <td>{{ $item->prix_unitaire * $item->quantite }} DT</td>
                    </tr>
                    @php
                        $total += $item->prix_unitaire * $item->quantite;
                     //   dd($total);
                    @endphp
                    
                @endforeach
                <tr>
                    <td></td>
                    <td>Frais de livraison</td>
                    <td> {{ $frais_livraison }} </td>
                    <td>01</td>
                    <th> {{ $frais_livraison }} </th>
                </tr>
                <tr class="total">
                    <td colspan="4"><strong>Total</strong></td>
                    <td><strong>{{ $total }} DT</strong></td>
                </tr>
            </tbody>
        </table>
        <p>Your order will be processed soon. Thank you for shopping with us!</p>
    </div>
</body>

</html>
