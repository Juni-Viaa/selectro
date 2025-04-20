
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/konfirmasi_selesai.css">
    <title>Konfirmasi Pembayaran</title>
</head>
<body>
    <div class = "invoice-wrapper" id = "print-area">
        <div class = "invoice">
            <div class = "invoice-container">
                <div class = "invoice-head">
                    <div class = "invoice-head-top">
                        <div class = "invoice-head-top-left text-start">
                            <span>Selectro</span>
                        </div>
                        <div class = "invoice-head-top-right text-end">
                            <h3>Pembayaran</h3>
                        </div>
                    </div>
                    <div class = "hr"></div>
                    <div class = "invoice-head-middle">
                        <div class = "invoice-head-middle-left text-start">
                            <p><span class = "text-bold">Date</span>: 05/12/2020</p>
                        </div>
                        <div class = "invoice-head-middle-right text-end">
                            <p><spanf class = "text-bold">Invoice No:</span>16789</p>
                        </div>
                    </div>
                    <div class = "hr"></div>
                    <div class = "invoice-head-bottom">
                        <div class = "invoice-head-bottom-left">
                            <ul>
                                <li class = 'text-bold'>Tagihan Ke:</li>
                                <p>Nama: </p>
                                <p>Alamat: </p>
                            </ul>
                        </div>
                        <div class = "invoice-head-bottom-right">
                            <ul class = "text-end">
                                <li class = 'text-bold'>Pembayaran Ke:</li>
                                <li>Selectro</li>
                                <li>Batam</li>
                                <li>0821 4300 3406</li>
                                <li>selectro@gmail.com</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class = "overflow-view">
                    <div class = "invoice-body">
                        <table>
                            <thead>
                                <tr>
                                    <td class = "text-bold">Nama Produk</td>
                                    <td class = "text-bold">Harga</td>
                                    <td class = "text-bold">Jumlah</td>
                                    <td class = "text-bold">Total</td>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>NAME</td>
                                    <td>Rp </td>
                                    <td>JUMLAH</td>
                                    <td>Rp </td>
                                </tr>
                                

                            </tbody>
                        </table>
                        <div class = "invoice-body-bottom">
                            <div class = "invoice-body-info-item">
                                <div class = "info-item-td text-end text-bold">Total:</div>
                                <div class = "info-item-td text-end">Rp </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class = "invoice-foot text-center">
                    <p><span class = "text-bold text-center">NOTE:&nbsp;</span>Ini struk yang dibuat oleh komputer tidak memerlukan tanda tangan fisik.</p>
                    <div class="invoice-btns">
                        <button onclick="window.print()" class="btn">
                            <span>
                                <i class="fa-solid fa-print"></i>
                            </span>
                            <span>Cetak Bukti Pembayaran</span>
                        </button>
                    </div>
                    <div class="invoice-btns">
                        <button type="button" class="invoice-btn">
                            <a href="keranjang.php" class="btn btn-secondary"><span> Kembali ke Keranjang</span></a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src = ".../js/script.js"></script>
</body>
</html>