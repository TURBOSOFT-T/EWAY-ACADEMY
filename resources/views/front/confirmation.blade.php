<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Félicitations pour votre commande</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('/icons/v870-tang-36.jpg') no-repeat;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            direction: rtl !important
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 30px;
            max-width: 500px;
            width: 100%;
            text-align: center;
        }

        .glass-effect h1 {
            color: #000000;
        }

        .glass-effect p {
            color: #000000;
        }
        .produit{
            border-radius: 10px;
            border:solid 2px #98d4ca;
        }
    </style>
</head>

<body>
    @if ($produit)
        <div class="glass-effect">
            <img width="100" height="100" src="https://img.icons8.com/fluency/100/ok--v1.png" alt="ok--v1" />
            <h1>
                تهانينا على طلبك.
            </h1>
            <p>
                سوف تتلقى مكالمة للتأكيد في بضع دقائق.
            </p>
            <div class="card p-2">
                <div class="d-flex justify-content-start">
                    <div>
                        <img src="{{ Storage::url($produit->photo) }}"
                            alt="produit" height="80" class="produit" srcset="">
                    </div>
                    <div class="my-auto p-2">
                        <h5>
                           {{ $produit->nom }}
                        </h5>
                        <div>
                            العنصر الذي طلبته للتو.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</body>

</html>
