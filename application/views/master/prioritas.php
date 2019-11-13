<html>
    <head>
        <title>Count Priority Formula</title>

        <style>
            body {
                    margin-top: 1.5cm;
                    margin-left: 1cm;
                    margin-right: 1cm;
                    margin-bottom: 1cm;
                }
            .page_break2 { page-break-after: always; text-align:center;}
            .page_break { page-break-before: always; text-align:center;}

            @page {
                margin: 0cm 0cm;
            }

            table, td, th {  
            border: 1px solid #ddd;
            text-align: left;
            border:1px solid #dedede;
            padding: 1rem;
            }

            table {
            border-collapse: collapse;
            width: 100%;
            }
            .grey {
                background-color:#c6c9ce;
            }
            th, td {
            padding: 15px;
            }
        </style>

    </head>
    <body>
        <div align="center" class="">
            <table>
                <tr>
                    <th style="text-align:center;" colspan="2">Resource (Max 20)</th>
                    <th style="text-align:center;" colspan="2">Time (Max 20)</th>
                    <th style="text-align:center;" colspan="2">Complexity (Max 25)</th>
                    <th style="text-align:center;" colspan="2">Category (Max 40)</th>
                    <th style="text-align:center;" colspan="2">Budget (Max 25)</th>
                </tr>
                <tr>
                    <td>Internal</td>
                    <td>10 Point</td>
                    <td>1 Month</td>
                    <td>3 Point</td>
                    <td>Civil</td>
                    <td>5 Point</td>
                    <td>Business Continuity Planning</td>
                    <td>5 Point</td>
                    <td><= 15 jt</td>
                    <td>3 Point</td>
                </tr>
                <tr>
                    <td>External</td>
                    <td>10 Point</td>
                    <td>2 Month</td>
                    <td>6 Point</td>
                    <td>Technical</td>
                    <td>5 Point</td>
                    <td>Business Process Re-engineering</td>
                    <td>5 Point</td>
                    <td>> 15 jt & <= 50 jt</td>
                    <td>5 Point</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>3 Month</td>
                    <td>9 Point</td>
                    <td>Electrical</td>
                    <td>5 Point</td>
                    <td>Cost Reduction</td>
                    <td>5 Point</td>
                    <td>> 50 jt & <= 100 jt</td>
                    <td>7 Point</td>
                </tr>
                <tr>
                    
                    <td></td>
                    <td></td>
                    <td>4 Month</td>
                    <td>15 Point</td>
                    <td>Environment</td>
                    <td>5 Point</td>
                    <td>Environment</td>
                    <td>5 Point</td>
                    <td>> 100jt & <= 250jt</td>
                    <td>10 Point</td>
                </tr>
                <tr>
                    
                    <td></td>
                    <td></td>
                    <td>5 Month</td>
                    <td>20 Point</td>
                    <td>Legality</td>
                    <td>5 Point</td>
                    <td>Process Improvement</td>
                    <td>5 Point</td>
                    <td>> 250 jt & <= 500jt</td>
                    <td>15 Point</td>
                </tr>
                <tr>
                    
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Regulation</td>
                    <td>5 Point</td>
                    <td>> 500jt & <= 1 M</td>
                    <td>20 Point</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Safety</td>
                    <td>5 Point</td>
                    <td>> 1 M</td>
                    <td>25 Point</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Strategic Planning</td>
                    <td>5 Point</td>
                    <td></td>
                    <td></td>
                </tr>
            </table>

            <div class="page_break">
                <table>
                    <tr>
                        <th>Benchmark</th>
                        <th>Formula Max Point</th>
                        <th>Result Max Point</th>
                    </tr>
                    <tr>
                        <td>Resource</td>
                        <td>20 x 15%</td>
                        <td>3 Point</td>
                    </tr>
                    <tr>
                        <td>Time</td>
                        <td>20 x 15%</td>
                        <td>3 Point</td>
                    </tr>
                    <tr>
                        <td>Complexity</td>
                        <td>25 x 20%</td>
                        <td>5 Point</td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td>40 x 30%</td>
                        <td>12 Point</td>
                    </tr>
                    <tr>
                        <td>Budget</td>
                        <td>25 x 20%</td>
                        <td>5 Point</td>
                    </tr>
                    <tr>
                        <td style="border-left:1px solid white;border-bottom:1 px solid white;"></td>
                        <td style="border-left:1px solid black;">Total Maximal Point</td>
                        <td>28 Point</td>
                    </tr>

                </table>

                <table>
                    <tr>
                        <th>Priority</th>
                        <th>Information</th>
                    </tr>
                    <tr>
                        <td>GOLD</td>
                        <td>
                        Point Lebih Dari 18 Point
                        </td>
                    </tr>
                    <tr>
                        <td>SILVER</td>
                        <td>
                        Point Lebih Dari 9 Point Dan Kurang Dari / Sama Dengan 18 Point
                        </td>
                    </tr>
                    <tr>
                        <td>BRONZE</td>
                        <td>
                        Point Kurang Dari / Sama Dengan 9 Point
                        </td>
                    </tr>
                </table>
            </div>
            
        </div>
    </body>
</html>