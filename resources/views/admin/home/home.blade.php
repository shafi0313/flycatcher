@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')

<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Dashboard</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Home</a>
                            </li>

                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">

        </div>
    </div>
    <div class="content-body">
        <!-- Basic Horizontal form layout section start -->
        <section id="basic-horizontal-layouts">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">User wise Customer Count</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <th>Customer Count</th>
                                    </tr>
                                    @foreach($marketing_users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->customers->count() }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Work order Count</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <th>Total Count</th>
                                    </tr>

                                    @foreach($marketing_users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->orders->count() }}</td>
                                    </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Basic Horizontal form layout section end -->
        <!-- Basic Horizontal form layout section start -->
        <section id="basic-horizontal-layouts">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Pending Order Count</h4>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>Marketing</th>
                                        <th>COO</th>
                                        <th>NOC Pending</th>
                                        <th>NOC Processing</th>
                                        <th>Account</th>
                                    </tr>
                                    <tr>

                                        <td>{{ \App\Models\OrderApproval::where('m_approved_status','Pending')->count() }}</td>
                                        <td>{{ \App\Models\OrderApproval::where('coo_approved_status','Pending')->count() }}</td>
                                        <td>{{ \App\Models\OrderApproval::where('noc_approved_status','Pending')->count() }}</td>
                                        <td>{{ \App\Models\OrderApproval::where('m_approved_status','Pending')->count() }}</td>
                                        <td>{{ \App\Models\OrderApproval::where('a_approved_status','Pending')->count() }}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Total Bandwidth</h4>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th></th>
                                        <th>Internet</th>
                                        <th>It Service 1</th>
                                        <th>It Service 2</th>
                                        <th>BDIX</th>
                                        <th>DATA</th>
                                    </tr>


                                    <tr>
                                        <td>Sell ISP</td>
                                        <td>61899</td>
                                        <td>133346</td>
                                        <td>81570</td>
                                        <td>3800</td>
                                        <td>9731</td>
                                    </tr>



                                    <tr>
                                        <td>Sell Corporate</td>
                                        <td>1139</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>42</td>
                                    </tr>



                                    <tr>
                                        <td>Buffer ISP</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>










































                                    <tr>
                                        <td>Buffer corporate</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- Basic Horizontal form layout section end -->
        <!-- Basic multiple Column Form section start -->
        <section id="multiple-column-form">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- <h4 class="card-title">Multiple Column</h4> -->
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>Order Id</th>
                                        <th>Name</th>
                                        <th>Organization</th>
                                        <th>CI1</th>
                                        <th>CI2</th>
                                        <th>CY1</th>
                                        <th>CY2</th>
                                        <th>CF1</th>
                                        <th>CF2</th>
                                        <th>CBDIX1</th>
                                        <th>CBDIX2</th>
                                        <th>CData</th>

                                    </tr>


                                    <tr>
                                        <td>3</td>
                                        <td style="max-width:100px">MD. Nazrul Islam</td>
                                        <td style="max-width:100px">Net Link BD</td>
                                        <td>480</td>
                                        <td>0</td>
                                        <td>1200</td>
                                        <td>0</td>
                                        <td class="fb1">760</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>8</td>
                                        <td style="max-width:100px">Md.Didar</td>
                                        <td style="max-width:100px">Didar IT</td>
                                        <td>800</td>
                                        <td>0</td>
                                        <td>1550</td>
                                        <td>0</td>
                                        <td class="fb1">1000</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>17</td>
                                        <td style="max-width:100px">Md. Anis Rahman khan </td>
                                        <td style="max-width:100px">Geo-Net</td>
                                        <td>1300</td>
                                        <td>0</td>
                                        <td>3500</td>
                                        <td>0</td>
                                        <td class="fb1">2200</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>18</td>
                                        <td style="max-width:100px">Md Noman</td>
                                        <td style="max-width:100px">Alifa Cyber Cafe</td>
                                        <td>700</td>
                                        <td>0</td>
                                        <td>1700</td>
                                        <td>0</td>
                                        <td class="fb1">1000</td>
                                        <td>300</td>
                                        <td>0</td>
                                        <td>248</td>
                                        <td>390</td>
                                    </tr>

                                    <tr>
                                        <td>20</td>
                                        <td style="max-width:100px"> Toslim Hossain</td>
                                        <td style="max-width:100px"> Talukdar Net </td>
                                        <td>520</td>
                                        <td>0</td>
                                        <td>1200</td>
                                        <td>0</td>
                                        <td class="fb1">950</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>27</td>
                                        <td style="max-width:100px">Salim molla</td>
                                        <td style="max-width:100px">Net City</td>
                                        <td>985</td>
                                        <td>0</td>
                                        <td>2850</td>
                                        <td>0</td>
                                        <td class="fb1">1860</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>28</td>
                                        <td style="max-width:100px">Mr.Enayet hossain</td>
                                        <td style="max-width:100px">Liz Fashion</td>
                                        <td>15</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>30</td>
                                        <td style="max-width:100px">Md.Habibul Islam Rajeb</td>
                                        <td style="max-width:100px">Padma Internet Cable Network</td>
                                        <td>140</td>
                                        <td>0</td>
                                        <td>250</td>
                                        <td>0</td>
                                        <td class="fb1">200</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>46</td>
                                        <td style="max-width:100px">Md.Shariful Islam</td>
                                        <td style="max-width:100px">Speednet Services @ Cyber Cafe</td>
                                        <td>300</td>
                                        <td>0</td>
                                        <td>1100</td>
                                        <td>0</td>
                                        <td class="fb1">400</td>
                                        <td>0</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>50</td>
                                        <td style="max-width:100px">Subrtto biswas</td>
                                        <td style="max-width:100px">Skynet Broadband Network</td>
                                        <td>2550</td>
                                        <td>0</td>
                                        <td>2500</td>
                                        <td>0</td>
                                        <td class="fb1">3000</td>
                                        <td>0</td>
                                        <td>500</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>51</td>
                                        <td style="max-width:100px">Asaduzzaman it</td>
                                        <td style="max-width:100px">Linda Eleastics ltd.</td>
                                        <td>30</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>52</td>
                                        <td style="max-width:100px">Saiful Islam</td>
                                        <td style="max-width:100px">Ministry Of Road Transport- Gazipur</td>
                                        <td>2</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>67</td>
                                        <td style="max-width:100px">Md. Masud Rana</td>
                                        <td style="max-width:100px">Masud IT</td>
                                        <td>600</td>
                                        <td>0</td>
                                        <td>1700</td>
                                        <td>0</td>
                                        <td class="fb1">600</td>
                                        <td>250</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>75</td>
                                        <td style="max-width:100px">Md Kawcher Ahmed</td>
                                        <td style="max-width:100px">Gangachara Online</td>
                                        <td>50</td>
                                        <td>0</td>
                                        <td>160</td>
                                        <td>0</td>
                                        <td class="fb1">50</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>100</td>
                                    </tr>

                                    <tr>
                                        <td>88</td>
                                        <td style="max-width:100px">Daily Jagoran</td>
                                        <td style="max-width:100px">Daliy Jagoran </td>
                                        <td>10</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>91</td>
                                        <td style="max-width:100px">Mr.Enayet hossain</td>
                                        <td style="max-width:100px">Lida Textile</td>
                                        <td>10</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>92</td>
                                        <td style="max-width:100px">Mr.Zahir Rayhan</td>
                                        <td style="max-width:100px">Young Optic BD</td>
                                        <td>60</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>100</td>
                                        <td style="max-width:100px">Nur Mohammad</td>
                                        <td style="max-width:100px">Sirajgonj Fiber Net</td>
                                        <td>90</td>
                                        <td>0</td>
                                        <td>220</td>
                                        <td>0</td>
                                        <td class="fb1">130</td>
                                        <td>0</td>
                                        <td>30</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>107</td>
                                        <td style="max-width:100px">Mihir Kumar Datta</td>
                                        <td style="max-width:100px">RN Link</td>
                                        <td>1140</td>
                                        <td>0</td>
                                        <td>500</td>
                                        <td>0</td>
                                        <td class="fb1">700</td>
                                        <td>0</td>
                                        <td>120</td>
                                        <td>0</td>
                                        <td>350</td>
                                    </tr>

                                    <tr>
                                        <td>117</td>
                                        <td style="max-width:100px">Al Masud Shakil (internet)</td>
                                        <td style="max-width:100px">BFC Place.com</td>
                                        <td>2</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>118</td>
                                        <td style="max-width:100px">Mr. Sojib</td>
                                        <td style="max-width:100px">Thunder Network</td>
                                        <td>800</td>
                                        <td>0</td>
                                        <td>2000</td>
                                        <td>0</td>
                                        <td class="fb1">1500</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>128</td>
                                        <td style="max-width:100px">Md. Harun or Rashid</td>
                                        <td style="max-width:100px">Desh genarel Insurance Limited- Savar Branch</td>
                                        <td>6</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>142</td>
                                        <td style="max-width:100px">Mr Milon</td>
                                        <td style="max-width:100px">Pandora Technology </td>
                                        <td>1500</td>
                                        <td>0</td>
                                        <td>4200</td>
                                        <td>0</td>
                                        <td class="fb1">3500</td>
                                        <td>0</td>
                                        <td>100</td>
                                        <td>1020</td>
                                        <td>1200</td>
                                    </tr>

                                    <tr>
                                        <td>149</td>
                                        <td style="max-width:100px">Md. Rasel </td>
                                        <td style="max-width:100px">Global Network</td>
                                        <td>185</td>
                                        <td>0</td>
                                        <td>750</td>
                                        <td>0</td>
                                        <td class="fb1">450</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>151</td>
                                        <td style="max-width:100px">Mr Minul</td>
                                        <td style="max-width:100px">Advance Data communication</td>
                                        <td>150</td>
                                        <td>0</td>
                                        <td>350</td>
                                        <td>0</td>
                                        <td class="fb1">200</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>157</td>
                                        <td style="max-width:100px">Md. Mizan IT</td>
                                        <td style="max-width:100px">Arkay Knit Dying Mills Ltd. (Palmal Group)</td>
                                        <td>15</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>165</td>
                                        <td style="max-width:100px">Md. Ziaur Rahman</td>
                                        <td style="max-width:100px">Aleef Network</td>
                                        <td>310</td>
                                        <td>0</td>
                                        <td>900</td>
                                        <td>0</td>
                                        <td class="fb1">260</td>
                                        <td>0</td>
                                        <td>20</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>168</td>
                                        <td style="max-width:100px">Mr Shamim</td>
                                        <td style="max-width:100px">Star Network BD</td>
                                        <td>190</td>
                                        <td>0</td>
                                        <td>360</td>
                                        <td>0</td>
                                        <td class="fb1">230</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>169</td>
                                        <td style="max-width:100px">Alauddin Al Azad</td>
                                        <td style="max-width:100px">Bangla Japan Trading Ltd</td>
                                        <td>10</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>170</td>
                                        <td style="max-width:100px">Md. Johirul Islam</td>
                                        <td style="max-width:100px">Central@Link Net</td>
                                        <td>420</td>
                                        <td>0</td>
                                        <td>1200</td>
                                        <td>0</td>
                                        <td class="fb1">600</td>
                                        <td>0</td>
                                        <td>200</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>171</td>
                                        <td style="max-width:100px">Md. Zibon </td>
                                        <td style="max-width:100px">Qian Xin Group.</td>
                                        <td>5</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>173</td>
                                        <td style="max-width:100px">Paul Niranjan</td>
                                        <td style="max-width:100px">Sabir Traders Ltd</td>
                                        <td>2</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>175</td>
                                        <td style="max-width:100px">Obaidur Rahaman</td>
                                        <td style="max-width:100px">Savar Uppozilla AC Land Office</td>
                                        <td>30</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>176</td>
                                        <td style="max-width:100px">Billal hossain</td>
                                        <td style="max-width:100px">Vanesa bangladesh ltd</td>
                                        <td>2</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>179</td>
                                        <td style="max-width:100px">Afzal Sir DGFI</td>
                                        <td style="max-width:100px">Celtrom EMS</td>
                                        <td>7</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>183</td>
                                        <td style="max-width:100px">Md Enamul Hossain</td>
                                        <td style="max-width:100px">Dhaka Pallibidyut Samity- 1</td>
                                        <td>2</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>187</td>
                                        <td style="max-width:100px">Md. Rasel Hossain</td>
                                        <td style="max-width:100px">T Mobile Point</td>
                                        <td>2</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>191</td>
                                        <td style="max-width:100px">Md. Ferdaour</td>
                                        <td style="max-width:100px">W &amp; W Company Limited</td>
                                        <td>3</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>193</td>
                                        <td style="max-width:100px">Md. Mostaque Gazi</td>
                                        <td style="max-width:100px">Doreen Garments Ltd.</td>
                                        <td>10</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>211</td>
                                        <td style="max-width:100px">Mejor Tazuddain</td>
                                        <td style="max-width:100px">SVR DET DGFI</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>30</td>
                                    </tr>

                                    <tr>
                                        <td>214</td>
                                        <td style="max-width:100px">Mr. Shiplo Raaman</td>
                                        <td style="max-width:100px">National Institute of Textile Engineering &amp; Research ( NITER) </td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>216</td>
                                        <td style="max-width:100px">Md. Mintu Mia</td>
                                        <td style="max-width:100px">Century Link Network</td>
                                        <td>560</td>
                                        <td>0</td>
                                        <td>1450</td>
                                        <td>0</td>
                                        <td class="fb1">1020</td>
                                        <td>0</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>217</td>
                                        <td style="max-width:100px">Md Rasel Meze</td>
                                        <td style="max-width:100px">Roshni Boardband Nework</td>
                                        <td>200</td>
                                        <td>0</td>
                                        <td>500</td>
                                        <td>0</td>
                                        <td class="fb1">250</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>218</td>
                                        <td style="max-width:100px">Mr. Habib</td>
                                        <td style="max-width:100px">Abroad</td>
                                        <td>413</td>
                                        <td>0</td>
                                        <td>700</td>
                                        <td>0</td>
                                        <td class="fb1">450</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>219</td>
                                        <td style="max-width:100px">Raisul Islam Tuhin</td>
                                        <td style="max-width:100px">Tuhin Enterprise</td>
                                        <td>300</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>222</td>
                                        <td style="max-width:100px">Md. Ali Hasan Shajeeb</td>
                                        <td style="max-width:100px">La- Muni Apparels ltd</td>
                                        <td>20</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>225</td>
                                        <td style="max-width:100px">Md uzzal</td>
                                        <td style="max-width:100px">B.MITT and Cyber Place</td>
                                        <td>650</td>
                                        <td>0</td>
                                        <td>3300</td>
                                        <td>0</td>
                                        <td class="fb1">1800</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>227</td>
                                        <td style="max-width:100px">Md Salim</td>
                                        <td style="max-width:100px">Alvi Online</td>
                                        <td>2400</td>
                                        <td>0</td>
                                        <td>6500</td>
                                        <td>0</td>
                                        <td class="fb1">3500</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>229</td>
                                        <td style="max-width:100px">Md Kamrul Hassan Sohag</td>
                                        <td style="max-width:100px">Dhamrai Network</td>
                                        <td>700</td>
                                        <td>0</td>
                                        <td>1800</td>
                                        <td>0</td>
                                        <td class="fb1">1100</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>230</td>
                                        <td style="max-width:100px">Mr. Rupom IT</td>
                                        <td style="max-width:100px">Oriental Ecowoods Ltd</td>
                                        <td>25</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>231</td>
                                        <td style="max-width:100px">Enyet hossain</td>
                                        <td style="max-width:100px">Office of the Executive Engineer (BREB)</td>
                                        <td>3</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>235</td>
                                        <td style="max-width:100px">Md Murad Hossain</td>
                                        <td style="max-width:100px">Asha Net BD</td>
                                        <td>410</td>
                                        <td>0</td>
                                        <td>1000</td>
                                        <td>0</td>
                                        <td class="fb1">600</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>240</td>
                                        <td style="max-width:100px">Md Nazmus Saadat</td>
                                        <td style="max-width:100px">Cyberlink Online</td>
                                        <td>320</td>
                                        <td>0</td>
                                        <td>300</td>
                                        <td>0</td>
                                        <td class="fb1">288</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>243</td>
                                        <td style="max-width:100px">Zahirul Islam</td>
                                        <td style="max-width:100px">Link technologies</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>450</td>
                                    </tr>

                                    <tr>
                                        <td>246</td>
                                        <td style="max-width:100px">Md Fysal Sohail</td>
                                        <td style="max-width:100px">Swift Internet</td>
                                        <td>245</td>
                                        <td>0</td>
                                        <td>600</td>
                                        <td>0</td>
                                        <td class="fb1">350</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>247</td>
                                        <td style="max-width:100px">Nazmul Hoq </td>
                                        <td style="max-width:100px">Kitty IndustriesLimited </td>
                                        <td>20</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>255</td>
                                        <td style="max-width:100px">Nur Huda Talukder</td>
                                        <td style="max-width:100px">Bay Footwear</td>
                                        <td>2</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>259</td>
                                        <td style="max-width:100px">Mr Malek Hossain</td>
                                        <td style="max-width:100px">Dhaka Thai Limited.</td>
                                        <td>15</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>260</td>
                                        <td style="max-width:100px">Mr.Rony</td>
                                        <td style="max-width:100px">NR Falcon Online</td>
                                        <td>400</td>
                                        <td>0</td>
                                        <td>600</td>
                                        <td>0</td>
                                        <td class="fb1">600</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>265</td>
                                        <td style="max-width:100px">Md. Kajol Hossain</td>
                                        <td style="max-width:100px">bharari.net</td>
                                        <td>300</td>
                                        <td>0</td>
                                        <td>1500</td>
                                        <td>0</td>
                                        <td class="fb1">300</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>268</td>
                                        <td style="max-width:100px">AG Agro Foods Ltd. </td>
                                        <td style="max-width:100px">AHSAN GROUP </td>
                                        <td>10</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>269</td>
                                        <td style="max-width:100px">Sharif Hossain</td>
                                        <td style="max-width:100px">LEO ICT Cable.</td>
                                        <td>10</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>270</td>
                                        <td style="max-width:100px">Aksid Corporation Limited </td>
                                        <td style="max-width:100px">Aksid Corporation Limited </td>
                                        <td>10</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>273</td>
                                        <td style="max-width:100px">Md. Harun or Rashid</td>
                                        <td style="max-width:100px">Global Insurance Limited- Jamgora Branch</td>
                                        <td>3</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>283</td>
                                        <td style="max-width:100px">Md. Shahriar Jibon</td>
                                        <td style="max-width:100px">JS. Internet</td>
                                        <td>180</td>
                                        <td>0</td>
                                        <td>500</td>
                                        <td>0</td>
                                        <td class="fb1">220</td>
                                        <td>0</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>288</td>
                                        <td style="max-width:100px">Md. Lovlo Mizan</td>
                                        <td style="max-width:100px">Momo Fashion Ltd</td>
                                        <td>5</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>290</td>
                                        <td style="max-width:100px">Mahbuba Sultana</td>
                                        <td style="max-width:100px">Nikunja Communication</td>
                                        <td>310</td>
                                        <td>0</td>
                                        <td>600</td>
                                        <td>0</td>
                                        <td class="fb1">400</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>291</td>
                                        <td style="max-width:100px">Md. Rackib Ahmed</td>
                                        <td style="max-width:100px">Tahfizul Quranil Karim Fazil (B.A) Madrasah</td>
                                        <td>6</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>300</td>
                                        <td style="max-width:100px">Masudul Islam</td>
                                        <td style="max-width:100px">Bee Online</td>
                                        <td></td>
                                        <td>0</td>
                                        <td>1000</td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>312</td>
                                        <td style="max-width:100px">Tareq Parves AGM</td>
                                        <td style="max-width:100px">SARBS Communication ltd</td>
                                        <td>10</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>317</td>
                                        <td style="max-width:100px">Md. Shamsul Islam Shohel</td>
                                        <td style="max-width:100px">SGWICUS (BD) LIMITED</td>
                                        <td>60</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>318</td>
                                        <td style="max-width:100px">Md Hasanul Haque Rubel</td>
                                        <td style="max-width:100px">SHAD FASHION LIMITED</td>
                                        <td>30</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>324</td>
                                        <td style="max-width:100px">Shanaz Akhter</td>
                                        <td style="max-width:100px">BD Banasree Dot Net</td>
                                        <td>90</td>
                                        <td>0</td>
                                        <td>165</td>
                                        <td>0</td>
                                        <td class="fb1">120</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>325</td>
                                        <td style="max-width:100px">Kaniz Subarna</td>
                                        <td style="max-width:100px">Potato Internet Service Provider</td>
                                        <td>200</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>358</td>
                                        <td style="max-width:100px">Md Pallab</td>
                                        <td style="max-width:100px">Hin Getah Bangladesh Limited</td>
                                        <td>10</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>368</td>
                                        <td style="max-width:100px">Ridoan zahan</td>
                                        <td style="max-width:100px">Brothers Online Limited</td>
                                        <td>1050</td>
                                        <td>0</td>
                                        <td>3501</td>
                                        <td>0</td>
                                        <td class="fb1">1800</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>369</td>
                                        <td style="max-width:100px">Md. Ashrsafuzzaman</td>
                                        <td style="max-width:100px">Masi Hata Sweaters Limited- Data</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>12</td>
                                    </tr>

                                    <tr>
                                        <td>373</td>
                                        <td style="max-width:100px">A.T.M Maniruzzaman</td>
                                        <td style="max-width:100px">Pipex Network</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>330</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>379</td>
                                        <td style="max-width:100px">Md. Ebnul Haque</td>
                                        <td style="max-width:100px">M/S Speed Link</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>1000</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>250</td>
                                    </tr>

                                    <tr>
                                        <td>387</td>
                                        <td style="max-width:100px">MD.Jahirul Islam</td>
                                        <td style="max-width:100px">Mesh Network</td>
                                        <td>1250</td>
                                        <td>0</td>
                                        <td>4000</td>
                                        <td>0</td>
                                        <td class="fb1">2100</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>391</td>
                                        <td style="max-width:100px">Kayum Munshi</td>
                                        <td style="max-width:100px">BDM Internet</td>
                                        <td>380</td>
                                        <td>0</td>
                                        <td>700</td>
                                        <td>0</td>
                                        <td class="fb1">630</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>393</td>
                                        <td style="max-width:100px">Samson Bayen </td>
                                        <td style="max-width:100px">CNK Hardwear BD Ltd</td>
                                        <td>5</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>395</td>
                                        <td style="max-width:100px">MD. Asraful Islam </td>
                                        <td style="max-width:100px">Dongbang Facilities (BD) Ltd</td>
                                        <td>5</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>396</td>
                                        <td style="max-width:100px">Md Mahadi hasan</td>
                                        <td style="max-width:100px">Navana C.N.G Ltd (Nobinagor)</td>
                                        <td>2</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>397</td>
                                        <td style="max-width:100px">Md Mahadi hasan</td>
                                        <td style="max-width:100px">Navana C.N.G Ltd (Baipail)</td>
                                        <td>2</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>398</td>
                                        <td style="max-width:100px">Md Mahadi hasan</td>
                                        <td style="max-width:100px">Navana C.N.G Ltd (Matborbari)</td>
                                        <td>3</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>399</td>
                                        <td style="max-width:100px">Md Arfan Hassan</td>
                                        <td style="max-width:100px">Friends Broadband Network </td>
                                        <td>300</td>
                                        <td>0</td>
                                        <td>750</td>
                                        <td>0</td>
                                        <td class="fb1">550</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>450</td>
                                    </tr>

                                    <tr>
                                        <td>401</td>
                                        <td style="max-width:100px">Md Masum</td>
                                        <td style="max-width:100px">Ruposi Bangla Sewater Ltd.</td>
                                        <td>2</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>403</td>
                                        <td style="max-width:100px">Md Osman Goni</td>
                                        <td style="max-width:100px">Savar Cantonment Board Girls High School</td>
                                        <td>1</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>405</td>
                                        <td style="max-width:100px">Md Kawcher Ahmed</td>
                                        <td style="max-width:100px">Gangachara online 2nd link</td>
                                        <td>75</td>
                                        <td>0</td>
                                        <td>80</td>
                                        <td>0</td>
                                        <td class="fb1">45</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>100</td>
                                    </tr>

                                    <tr>
                                        <td>406</td>
                                        <td style="max-width:100px">Md Masudur Rahman</td>
                                        <td style="max-width:100px">Master IT</td>
                                        <td>200</td>
                                        <td>0</td>
                                        <td>180</td>
                                        <td>0</td>
                                        <td class="fb1">100</td>
                                        <td>0</td>
                                        <td>20</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>407</td>
                                        <td style="max-width:100px"> Sayem Abdullah Rihan</td>
                                        <td style="max-width:100px">REDX Logistics Limited (Banani)</td>
                                        <td>10</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>408</td>
                                        <td style="max-width:100px">Sayem Abdullah Rihan</td>
                                        <td style="max-width:100px">REDX Logistics Limited (Babubazar)</td>
                                        <td>10</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>409</td>
                                        <td style="max-width:100px">Sayem Abdullah Rihan</td>
                                        <td style="max-width:100px">REDX Logistics Limited (kolabagan)</td>
                                        <td>20</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>410</td>
                                        <td style="max-width:100px">MD.SAKHAOUT HOSSIN SUJAN</td>
                                        <td style="max-width:100px">SJS Net Connection</td>
                                        <td>730</td>
                                        <td>0</td>
                                        <td>2000</td>
                                        <td>0</td>
                                        <td class="fb1">1300</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>411</td>
                                        <td style="max-width:100px">Sayem Abdullah Rihan</td>
                                        <td style="max-width:100px">REDX Logistics Limited (Jatrabari)</td>
                                        <td>10</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>413</td>
                                        <td style="max-width:100px">Md. Aminul Fakir</td>
                                        <td style="max-width:100px">Power Media </td>
                                        <td>155</td>
                                        <td>0</td>
                                        <td>500</td>
                                        <td>0</td>
                                        <td class="fb1">230</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>415</td>
                                        <td style="max-width:100px">Sayem Abdullah Rihan</td>
                                        <td style="max-width:100px">REDX Logistics Limited (Uttara)</td>
                                        <td>10</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>417</td>
                                        <td style="max-width:100px">Aminul Islam</td>
                                        <td style="max-width:100px">PRIME BANK LTD</td>
                                        <td>2</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>421</td>
                                        <td style="max-width:100px">Md. Ashrsafuzzaman</td>
                                        <td style="max-width:100px">Masi Hata Sweaters Limited- Internet</td>
                                        <td>5</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>427</td>
                                        <td style="max-width:100px">Md Shohid</td>
                                        <td style="max-width:100px">Ideal Net</td>
                                        <td>1</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>428</td>
                                        <td style="max-width:100px">S A Jubayer</td>
                                        <td style="max-width:100px">Ma Babar Dowa Telecom </td>
                                        <td>3</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>429</td>
                                        <td style="max-width:100px">Hellmann Worldwide Logistics Limited</td>
                                        <td style="max-width:100px">Tchibo GmbH Bangladesh Liaison Office</td>
                                        <td>25</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>441</td>
                                        <td style="max-width:100px">Saiful islam</td>
                                        <td style="max-width:100px">Ministry Of Road Transport- Noyerhat</td>
                                        <td>2</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>442</td>
                                        <td style="max-width:100px">Saiful islam</td>
                                        <td style="max-width:100px">Ministry Of Road Transport- Chandora</td>
                                        <td>2</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>444</td>
                                        <td style="max-width:100px">Saiful islam</td>
                                        <td style="max-width:100px">Ministry Of Road Transport- Baipail</td>
                                        <td>2</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>445</td>
                                        <td style="max-width:100px">Saiful islam</td>
                                        <td style="max-width:100px">Ministry Of Road Transport- Nabinagor</td>
                                        <td>1</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>446</td>
                                        <td style="max-width:100px">Md.Milon Hawladar</td>
                                        <td style="max-width:100px">Aftab Nagar online services (ANOS)</td>
                                        <td>150</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>448</td>
                                        <td style="max-width:100px">MD.Akbor Hossain</td>
                                        <td style="max-width:100px">M/S Akbor Power Net</td>
                                        <td>300</td>
                                        <td>0</td>
                                        <td>700</td>
                                        <td>0</td>
                                        <td class="fb1">500</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>451</td>
                                        <td style="max-width:100px">Reaz Motor</td>
                                        <td style="max-width:100px">Radio 71</td>
                                        <td>40</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>452</td>
                                        <td style="max-width:100px">Md Arif Sohan</td>
                                        <td style="max-width:100px">HTL Fabricators Ltd.</td>
                                        <td>3</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>455</td>
                                        <td style="max-width:100px">Nazmul Hoque Chowdhury</td>
                                        <td style="max-width:100px">Palal Industrial Park</td>
                                        <td>1</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>457</td>
                                        <td style="max-width:100px">Md.Julhas Uddin</td>
                                        <td style="max-width:100px">C&amp;C Communication</td>
                                        <td>1565</td>
                                        <td>0</td>
                                        <td>5820</td>
                                        <td>0</td>
                                        <td class="fb1">650</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>459</td>
                                        <td style="max-width:100px">Sayem Abdullah Rihan</td>
                                        <td style="max-width:100px">REDX Logistics Limited (Malibagh)</td>
                                        <td>10</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>465</td>
                                        <td style="max-width:100px">Md.Abbas Uddin Mozumder</td>
                                        <td style="max-width:100px">M/S Cyber Planet</td>
                                        <td>575</td>
                                        <td>0</td>
                                        <td>1100</td>
                                        <td>0</td>
                                        <td class="fb1">950</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>470</td>
                                        <td style="max-width:100px">Md Hamid</td>
                                        <td style="max-width:100px">Uzzal Fabric's Limited</td>
                                        <td>3</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>477</td>
                                        <td style="max-width:100px">MD. Asaduzzaman Khan</td>
                                        <td style="max-width:100px">Master Net</td>
                                        <td>520</td>
                                        <td>0</td>
                                        <td>1400</td>
                                        <td>0</td>
                                        <td class="fb1">850</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>508</td>
                                        <td style="max-width:100px">Md Jahirul Islam</td>
                                        <td style="max-width:100px">A. R. Z Net</td>
                                        <td>220</td>
                                        <td>0</td>
                                        <td>500</td>
                                        <td>0</td>
                                        <td class="fb1">240</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>519</td>
                                        <td style="max-width:100px">Abdullah Al Maruf</td>
                                        <td style="max-width:100px">Moon Readywears Limited</td>
                                        <td>10</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>517</td>
                                        <td style="max-width:100px">MD. ATAUR RAHMAN</td>
                                        <td style="max-width:100px">Saadid BD Trusted Net</td>
                                        <td>120</td>
                                        <td>0</td>
                                        <td>400</td>
                                        <td>0</td>
                                        <td class="fb1">220</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>518</td>
                                        <td style="max-width:100px">MD. ATAUR RAHMAN</td>
                                        <td style="max-width:100px">Saadid BD Trusted Net 2nd link</td>
                                        <td>190</td>
                                        <td>0</td>
                                        <td>700</td>
                                        <td>0</td>
                                        <td class="fb1">300</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>521</td>
                                        <td style="max-width:100px">Md. Abdul Kadir Miah</td>
                                        <td style="max-width:100px">Duranta</td>
                                        <td>200</td>
                                        <td>0</td>
                                        <td>500</td>
                                        <td>0</td>
                                        <td class="fb1">330</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>522</td>
                                        <td style="max-width:100px">Rasel Mia</td>
                                        <td style="max-width:100px">Global Network (Secondary Link)</td>
                                        <td>381</td>
                                        <td>0</td>
                                        <td>1330</td>
                                        <td>0</td>
                                        <td class="fb1">615</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>514</td>
                                        <td style="max-width:100px">Md.Mohasin Karim</td>
                                        <td style="max-width:100px">Possibility Techno Ltd</td>
                                        <td>130</td>
                                        <td>0</td>
                                        <td>420</td>
                                        <td>0</td>
                                        <td class="fb1">200</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>510</td>
                                        <td style="max-width:100px">Mirza Ashraful Bari</td>
                                        <td style="max-width:100px">Dreamy Tech</td>
                                        <td>300</td>
                                        <td>0</td>
                                        <td>900</td>
                                        <td>0</td>
                                        <td class="fb1">350</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>506</td>
                                        <td style="max-width:100px">Ahamed Rosi</td>
                                        <td style="max-width:100px">High Range Internet Service</td>
                                        <td>400</td>
                                        <td>0</td>
                                        <td>1000</td>
                                        <td>0</td>
                                        <td class="fb1">600</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>504</td>
                                        <td style="max-width:100px">Mohammad Hossan</td>
                                        <td style="max-width:100px">Kalukhali Cable Network (Rajbari)</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>600</td>
                                    </tr>

                                    <tr>
                                        <td>503</td>
                                        <td style="max-width:100px">MD. Selim Ahmed</td>
                                        <td style="max-width:100px">F4 Internet Solutions</td>
                                        <td>350</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>502</td>
                                        <td style="max-width:100px">Md Anwar Hossain</td>
                                        <td style="max-width:100px">Anwar Enterprise</td>
                                        <td>265</td>
                                        <td>0</td>
                                        <td>550</td>
                                        <td>0</td>
                                        <td class="fb1">350</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>501</td>
                                        <td style="max-width:100px">Md Delwor Hossain</td>
                                        <td style="max-width:100px">Polly IT</td>
                                        <td>2000</td>
                                        <td>0</td>
                                        <td>2000</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>500</td>
                                        <td style="max-width:100px">Touhedul Islam</td>
                                        <td style="max-width:100px">Touhed Net</td>
                                        <td>335</td>
                                        <td>0</td>
                                        <td>1200</td>
                                        <td>0</td>
                                        <td class="fb1">637</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>497</td>
                                        <td style="max-width:100px">Mohammed Nur Alam</td>
                                        <td style="max-width:100px">Gen7 Online</td>
                                        <td>530</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>493</td>
                                        <td style="max-width:100px">MD. Salim Reza</td>
                                        <td style="max-width:100px">S.H. NETWORK</td>
                                        <td>310</td>
                                        <td>0</td>
                                        <td>650</td>
                                        <td>0</td>
                                        <td class="fb1">425</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>491</td>
                                        <td style="max-width:100px">Tomal Ahmed Bhuiyan</td>
                                        <td style="max-width:100px">TenLink Web</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>100</td>
                                    </tr>

                                    <tr>
                                        <td>524</td>
                                        <td style="max-width:100px">Nahidul Hassan</td>
                                        <td style="max-width:100px">Alpha Clothing Ltd.</td>
                                        <td>3</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>526</td>
                                        <td style="max-width:100px">Md Salim Molla</td>
                                        <td style="max-width:100px">Discovery 24 Online </td>
                                        <td>1100</td>
                                        <td>0</td>
                                        <td>3500</td>
                                        <td>0</td>
                                        <td class="fb1">2000</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>513</td>
                                        <td style="max-width:100px">Sayem Abdullah Rihan</td>
                                        <td style="max-width:100px">REDX Logistics Limited (Motijheel)</td>
                                        <td>10</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>528</td>
                                        <td style="max-width:100px">Md.Robiul Islam</td>
                                        <td style="max-width:100px">Metrocloud &amp; Agro</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>370</td>
                                    </tr>

                                    <tr>
                                        <td>532</td>
                                        <td style="max-width:100px">Mohammad Shahriar Hossain</td>
                                        <td style="max-width:100px">Zip Net Limited</td>
                                        <td></td>
                                        <td>0</td>
                                        <td>500</td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>534</td>
                                        <td style="max-width:100px">Md. Kawsar Mahmud</td>
                                        <td style="max-width:100px">Md. Kawsar Mahmud</td>
                                        <td>1</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>536</td>
                                        <td style="max-width:100px">Milon</td>
                                        <td style="max-width:100px">DEPZ Fair Station</td>
                                        <td>4</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>537</td>
                                        <td style="max-width:100px">Sayem Abdullah Rihan</td>
                                        <td style="max-width:100px">REDX Logistics Limited (Mirpur)</td>
                                        <td>10</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>539</td>
                                        <td style="max-width:100px">Asaduzzaman it</td>
                                        <td style="max-width:100px">Linda Accessories Ltd</td>
                                        <td>20</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>546</td>
                                        <td style="max-width:100px">Md Anisur Rahman Khan</td>
                                        <td style="max-width:100px">Geo-Net Secondary</td>
                                        <td>250</td>
                                        <td>0</td>
                                        <td>700</td>
                                        <td>0</td>
                                        <td class="fb1">350</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>547</td>
                                        <td style="max-width:100px">Mr Malek Hossain</td>
                                        <td style="max-width:100px">Dhaka Thai Limited To Mr, Rana</td>
                                        <td>2</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>548</td>
                                        <td style="max-width:100px">Faisal Khali Ashrafi</td>
                                        <td style="max-width:100px">Bandbox Limited.</td>
                                        <td>3</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>551</td>
                                        <td style="max-width:100px">Rasel</td>
                                        <td style="max-width:100px">Britto Network</td>
                                        <td>500</td>
                                        <td>0</td>
                                        <td>1600</td>
                                        <td>0</td>
                                        <td class="fb1">900</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>553</td>
                                        <td style="max-width:100px">Saiful Islam</td>
                                        <td style="max-width:100px">Ministry Of Road Transport- Noyerhat 2nd link</td>
                                        <td>3</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>554</td>
                                        <td style="max-width:100px">Bishal Tahsun</td>
                                        <td style="max-width:100px">Dresden Textiles Ltd.</td>
                                        <td>5</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>556</td>
                                        <td style="max-width:100px">Nasima Akter</td>
                                        <td style="max-width:100px">Afi IT and Computer Training Center.</td>
                                        <td>3</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>557</td>
                                        <td style="max-width:100px">Saddam Hossain</td>
                                        <td style="max-width:100px">Asian Network</td>
                                        <td>4000</td>
                                        <td>0</td>
                                        <td>500</td>
                                        <td>0</td>
                                        <td class="fb1">200</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>558</td>
                                        <td style="max-width:100px">Md Abu Shaleh </td>
                                        <td style="max-width:100px">AG Communication </td>
                                        <td>510</td>
                                        <td>0</td>
                                        <td>900</td>
                                        <td>0</td>
                                        <td class="fb1">600</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>559</td>
                                        <td style="max-width:100px">Md Shafiul Kader</td>
                                        <td style="max-width:100px">Gnet Internet Network Inc</td>
                                        <td>90</td>
                                        <td>0</td>
                                        <td>180</td>
                                        <td>0</td>
                                        <td class="fb1">150</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>561</td>
                                        <td style="max-width:100px">Mohammad Anisur Rahman</td>
                                        <td style="max-width:100px">Riham Enterprise </td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>200</td>
                                        <td>0</td>
                                        <td class="fb1">150</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>563</td>
                                        <td style="max-width:100px">Time Zone </td>
                                        <td style="max-width:100px">Time Zone</td>
                                        <td>2</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>565</td>
                                        <td style="max-width:100px">Md Nizam</td>
                                        <td style="max-width:100px">NS Net Connection </td>
                                        <td>470</td>
                                        <td>0</td>
                                        <td>1300</td>
                                        <td>0</td>
                                        <td class="fb1">750</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>567</td>
                                        <td style="max-width:100px">MD. Mustak Ahmed</td>
                                        <td style="max-width:100px">M/S MS Technology</td>
                                        <td>400</td>
                                        <td>0</td>
                                        <td>500</td>
                                        <td>0</td>
                                        <td class="fb1">300</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>568</td>
                                        <td style="max-width:100px">Md.Ariful Islam</td>
                                        <td style="max-width:100px">Home Internet</td>
                                        <td>350</td>
                                        <td>0</td>
                                        <td>750</td>
                                        <td>0</td>
                                        <td class="fb1">350</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>569</td>
                                        <td style="max-width:100px">Sharif Sikder</td>
                                        <td style="max-width:100px">SS CAP LTD.</td>
                                        <td>5</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>573</td>
                                        <td style="max-width:100px">Md. Badsha Sheikh</td>
                                        <td style="max-width:100px">Cloud Communication</td>
                                        <td>65</td>
                                        <td>0</td>
                                        <td>170</td>
                                        <td>0</td>
                                        <td class="fb1">130</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>490</td>
                                        <td style="max-width:100px">Md. Kawsar Howlader</td>
                                        <td style="max-width:100px">Sonar Bangla Insurance Ltd</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>580</td>
                                        <td style="max-width:100px">Sayem Abdullah Rihan</td>
                                        <td style="max-width:100px">REDX Logistics Limited (Jatrabari 2)</td>
                                        <td>2</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>583</td>
                                        <td style="max-width:100px">Asif Uzzaman</td>
                                        <td style="max-width:100px">Planet Three Communication</td>
                                        <td>1000</td>
                                        <td>0</td>
                                        <td>1500</td>
                                        <td>0</td>
                                        <td class="fb1">1800</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>584</td>
                                        <td style="max-width:100px">Md.Mofizul Islam Mafuz</td>
                                        <td style="max-width:100px">Digital BD.Net</td>
                                        <td>1200</td>
                                        <td>0</td>
                                        <td>3000</td>
                                        <td>0</td>
                                        <td class="fb1">1700</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>585</td>
                                        <td style="max-width:100px">Badsha Sheikh</td>
                                        <td style="max-width:100px">Cloud Communication Secondary Link</td>
                                        <td>110</td>
                                        <td>0</td>
                                        <td>300</td>
                                        <td>0</td>
                                        <td class="fb1">160</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>586</td>
                                        <td style="max-width:100px">Md Tutul Gong</td>
                                        <td style="max-width:100px">NBH Net</td>
                                        <td>470</td>
                                        <td>0</td>
                                        <td>1250</td>
                                        <td>0</td>
                                        <td class="fb1">750</td>
                                        <td>0</td>
                                        <td>50</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>587</td>
                                        <td style="max-width:100px">Md Belal Hossain</td>
                                        <td style="max-width:100px">Tilakpur Network </td>
                                        <td>210</td>
                                        <td>0</td>
                                        <td>500</td>
                                        <td>0</td>
                                        <td class="fb1">250</td>
                                        <td>0</td>
                                        <td>50</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>588</td>
                                        <td style="max-width:100px">Md Shafikul Islam</td>
                                        <td style="max-width:100px">Pabna Broadband Network </td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td>1001</td>
                                    </tr>

                                    <tr>
                                        <td>589</td>
                                        <td style="max-width:100px">kawsar Amin</td>
                                        <td style="max-width:100px">Speed Plus</td>
                                        <td>1900</td>
                                        <td>0</td>
                                        <td>900</td>
                                        <td>0</td>
                                        <td class="fb1">1400</td>
                                        <td>0</td>
                                        <td>200</td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>591</td>
                                        <td style="max-width:100px">Famous Specialized Hospital </td>
                                        <td style="max-width:100px">Famous Specialized Hospital</td>
                                        <td>30</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>592</td>
                                        <td style="max-width:100px">Maksudur Rashed</td>
                                        <td style="max-width:100px">Mogbazar Dot Net</td>
                                        <td>200</td>
                                        <td>0</td>
                                        <td>500</td>
                                        <td>0</td>
                                        <td class="fb1">200</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>593</td>
                                        <td style="max-width:100px">Dilruba Sharmin</td>
                                        <td style="max-width:100px">Dhaka-Shanghai Ceramics Ltd.</td>
                                        <td>30</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>595</td>
                                        <td style="max-width:100px">Sayem Abdullah Rihan</td>
                                        <td style="max-width:100px">Shopfront Limited (ShopUp) (Kamrangir chor)</td>
                                        <td>10</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>596</td>
                                        <td style="max-width:100px">A S M Saif </td>
                                        <td style="max-width:100px">One Uproar primary</td>
                                        <td>130</td>
                                        <td>0</td>
                                        <td>390</td>
                                        <td>0</td>
                                        <td class="fb1">110</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>597</td>
                                        <td style="max-width:100px">A S M Saif </td>
                                        <td style="max-width:100px">One Uproar Secondary </td>
                                        <td>70</td>
                                        <td>0</td>
                                        <td>250</td>
                                        <td>0</td>
                                        <td class="fb1">60</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>598</td>
                                        <td style="max-width:100px">Ramproshad Paul</td>
                                        <td style="max-width:100px">Technical training center (BREB) </td>
                                        <td>4</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>600</td>
                                        <td style="max-width:100px">Engr. Sumon Das</td>
                                        <td style="max-width:100px">Base Papers Ltd.</td>
                                        <td>20</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>601</td>
                                        <td style="max-width:100px">Sohel Arman</td>
                                        <td style="max-width:100px">Tangail Residential School &amp; College.</td>
                                        <td>15</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>603</td>
                                        <td style="max-width:100px">Md. Johurul Islam</td>
                                        <td style="max-width:100px">JS Network</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>380</td>
                                        <td>0</td>
                                        <td class="fb1">130</td>
                                        <td>0</td>
                                        <td>40</td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>604</td>
                                        <td style="max-width:100px">S.M.Zulfiquer Haidar</td>
                                        <td style="max-width:100px">M/S. Tetrasoft</td>
                                        <td>850</td>
                                        <td>0</td>
                                        <td>1700</td>
                                        <td>0</td>
                                        <td class="fb1">1500</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>605</td>
                                        <td style="max-width:100px">Md. Rassel Sardar Sumon</td>
                                        <td style="max-width:100px">Sumon Network</td>
                                        <td>350</td>
                                        <td>0</td>
                                        <td>750</td>
                                        <td>0</td>
                                        <td class="fb1">600</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>606</td>
                                        <td style="max-width:100px">Md Kawsar Ahammed</td>
                                        <td style="max-width:100px">Kawsar It</td>
                                        <td>200</td>
                                        <td>0</td>
                                        <td>700</td>
                                        <td>0</td>
                                        <td class="fb1">250</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>607</td>
                                        <td style="max-width:100px">Md. Hamidul Islam</td>
                                        <td style="max-width:100px">M/S MTN.COM</td>
                                        <td>400</td>
                                        <td>0</td>
                                        <td>1200</td>
                                        <td>0</td>
                                        <td class="fb1">1000</td>
                                        <td>0</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>609</td>
                                        <td style="max-width:100px">Md. Anoar Hosen</td>
                                        <td style="max-width:100px">M/S Sun Online</td>
                                        <td>1050</td>
                                        <td>0</td>
                                        <td>3200</td>
                                        <td>0</td>
                                        <td class="fb1">2800</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>610</td>
                                        <td style="max-width:100px">Md. Abul Kashem</td>
                                        <td style="max-width:100px">Active Network</td>
                                        <td>175</td>
                                        <td>0</td>
                                        <td>320</td>
                                        <td>0</td>
                                        <td class="fb1">300</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>613</td>
                                        <td style="max-width:100px">Md. Jashim Uddin</td>
                                        <td style="max-width:100px">JS Network</td>
                                        <td>540</td>
                                        <td>0</td>
                                        <td>1240</td>
                                        <td>0</td>
                                        <td class="fb1">930</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>614</td>
                                        <td style="max-width:100px">Md. Sheikh Masum</td>
                                        <td style="max-width:100px">Online Cyber cafe and Computer</td>
                                        <td>170</td>
                                        <td>0</td>
                                        <td>460</td>
                                        <td>0</td>
                                        <td class="fb1">230</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>616</td>
                                        <td style="max-width:100px">Atikur Rahaman Manik</td>
                                        <td style="max-width:100px">Wave Net</td>
                                        <td>440</td>
                                        <td>0</td>
                                        <td>880</td>
                                        <td>0</td>
                                        <td class="fb1">460</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>617</td>
                                        <td style="max-width:100px">Md. Nasir Uddin</td>
                                        <td style="max-width:100px">M/S Speed Tech Online</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1">2000</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>618</td>
                                        <td style="max-width:100px">Md saiful Islam</td>
                                        <td style="max-width:100px">Jhongkar Engineers</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>3335</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>619</td>
                                        <td style="max-width:100px">Md Anowarul Haque</td>
                                        <td style="max-width:100px">Net Vishion</td>
                                        <td>50</td>
                                        <td>0</td>
                                        <td>50</td>
                                        <td>0</td>
                                        <td class="fb1">40</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>622</td>
                                        <td style="max-width:100px">Abdur Rahim</td>
                                        <td style="max-width:100px">RB BD INTERNETWORK</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>250</td>
                                        <td>0</td>
                                        <td class="fb1">120</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>624</td>
                                        <td style="max-width:100px">Engr. Sumon Das</td>
                                        <td style="max-width:100px">AKASH CNG FILLING</td>
                                        <td>5</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>625</td>
                                        <td style="max-width:100px">Golam Shahriar</td>
                                        <td style="max-width:100px">Lead Technology</td>
                                        <td>150</td>
                                        <td>0</td>
                                        <td>600</td>
                                        <td>0</td>
                                        <td class="fb1">250</td>
                                        <td>0</td>
                                        <td>50</td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>626</td>
                                        <td style="max-width:100px">Md. Mizanur Rahman</td>
                                        <td style="max-width:100px">Bandhu Network System</td>
                                        <td>1500</td>
                                        <td>0</td>
                                        <td>5000</td>
                                        <td>0</td>
                                        <td class="fb1">2500</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>627</td>
                                        <td style="max-width:100px">Md Milon</td>
                                        <td style="max-width:100px">Crazy Net</td>
                                        <td>850</td>
                                        <td>0</td>
                                        <td>3000</td>
                                        <td>0</td>
                                        <td class="fb1">1500</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>630</td>
                                        <td style="max-width:100px">Md Ramjan Ali</td>
                                        <td style="max-width:100px">Brothers Broadband Network</td>
                                        <td>120</td>
                                        <td>0</td>
                                        <td>580</td>
                                        <td>0</td>
                                        <td class="fb1">200</td>
                                        <td>0</td>
                                        <td>101</td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>631</td>
                                        <td style="max-width:100px">Abdullah Al Mahbub</td>
                                        <td style="max-width:100px">Web Connection</td>
                                        <td>220</td>
                                        <td>0</td>
                                        <td>500</td>
                                        <td>0</td>
                                        <td class="fb1">280</td>
                                        <td>0</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>632</td>
                                        <td style="max-width:100px">Md Mohsin Mia</td>
                                        <td style="max-width:100px">M/s Dhaka Online</td>
                                        <td>120</td>
                                        <td>0</td>
                                        <td>200</td>
                                        <td>0</td>
                                        <td class="fb1">100</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>633</td>
                                        <td style="max-width:100px">Ebrahim kholil</td>
                                        <td style="max-width:100px">Palashbari Online </td>
                                        <td>370</td>
                                        <td>0</td>
                                        <td>1000</td>
                                        <td>0</td>
                                        <td class="fb1">550</td>
                                        <td>0</td>
                                        <td>130</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>634</td>
                                        <td style="max-width:100px">Md Jewel </td>
                                        <td style="max-width:100px">Trishal Net</td>
                                        <td>2000</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">2200</td>
                                        <td>0</td>
                                        <td>300</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>636</td>
                                        <td style="max-width:100px">Md. Kamrul Alam</td>
                                        <td style="max-width:100px">IR Technology</td>
                                        <td>170</td>
                                        <td>0</td>
                                        <td>530</td>
                                        <td>0</td>
                                        <td class="fb1">200</td>
                                        <td>0</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>637</td>
                                        <td style="max-width:100px">Sharif Ahmed Sujon</td>
                                        <td style="max-width:100px">Net E Zen</td>
                                        <td>250</td>
                                        <td>0</td>
                                        <td>400</td>
                                        <td>0</td>
                                        <td class="fb1">350</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>638</td>
                                        <td style="max-width:100px">Md. Arafat Rahaman</td>
                                        <td style="max-width:100px">BEAUFORT TOWER.</td>
                                        <td>15</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>639</td>
                                        <td style="max-width:100px">Md.Julhas Uddin</td>
                                        <td style="max-width:100px">C&amp;C Communication 2nd </td>
                                        <td>250</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>640</td>
                                        <td style="max-width:100px">Mr, Sohidul</td>
                                        <td style="max-width:100px">Hyun Apparels Limited.</td>
                                        <td>10</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>642</td>
                                        <td style="max-width:100px">Md Sohel Rana</td>
                                        <td style="max-width:100px">Stormnet ISP</td>
                                        <td>530</td>
                                        <td>0</td>
                                        <td>1000</td>
                                        <td>0</td>
                                        <td class="fb1">1000</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>644</td>
                                        <td style="max-width:100px">Md. Moinul Hossain</td>
                                        <td style="max-width:100px">Asian city online bd. LTD</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>1050</td>
                                        <td>0</td>
                                        <td class="fb1">950</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>645</td>
                                        <td style="max-width:100px">Md Tarikul Islam Shohel</td>
                                        <td style="max-width:100px">JAE MEE EMBOTITCH (PVT) LTD.</td>
                                        <td>15</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="fb1">0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>646</td>
                                        <td style="max-width:100px">Hossain Ahmed Masum</td>
                                        <td style="max-width:100px">Alicon Network</td>
                                        <td>450</td>
                                        <td>0</td>
                                        <td>600</td>
                                        <td>0</td>
                                        <td class="fb1">500</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>647</td>
                                        <td style="max-width:100px">Abu Syeed Muhammad Al Hassan </td>
                                        <td style="max-width:100px">Reign ICT</td>
                                        <td>800</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>648</td>
                                        <td style="max-width:100px">Toslim Hossain</td>
                                        <td style="max-width:100px">Talukdar Net (DLoad Network)</td>
                                        <td>470</td>
                                        <td>0</td>
                                        <td>1400</td>
                                        <td>0</td>
                                        <td class="fb1">800</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>649</td>
                                        <td style="max-width:100px">Taslima</td>
                                        <td style="max-width:100px">Ssb Online</td>
                                        <td>320</td>
                                        <td>0</td>
                                        <td>815</td>
                                        <td>0</td>
                                        <td class="fb1">650</td>
                                        <td>0</td>
                                        <td>1</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>650</td>
                                        <td style="max-width:100px">Shahinur Islam Dipu</td>
                                        <td style="max-width:100px">Round Network</td>
                                        <td>160</td>
                                        <td>0</td>
                                        <td>500</td>
                                        <td>0</td>
                                        <td class="fb1">240</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>651</td>
                                        <td style="max-width:100px">Abu Jafor Md Saleh</td>
                                        <td style="max-width:100px">Unity Enterprise</td>
                                        <td>180</td>
                                        <td>0</td>
                                        <td>300</td>
                                        <td>0</td>
                                        <td class="fb1">200</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>652</td>
                                        <td style="max-width:100px">Md Shafikul Islam</td>
                                        <td style="max-width:100px">Runway Broadband</td>
                                        <td>70</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>653</td>
                                        <td style="max-width:100px">Md. Saiful Islam</td>
                                        <td style="max-width:100px">Md. Saiful Islam</td>
                                        <td>1</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>654</td>
                                        <td style="max-width:100px">Muktadir Billah</td>
                                        <td style="max-width:100px">Bani Networks LTD</td>
                                        <td></td>
                                        <td>0</td>
                                        <td>800</td>
                                        <td>0</td>
                                        <td class="fb1">600</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>655</td>
                                        <td style="max-width:100px">Saiful Islam</td>
                                        <td style="max-width:100px">Ministry Of Road Transport- Vogra Baipas</td>
                                        <td>2</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>656</td>
                                        <td style="max-width:100px">Sayem Abdullah Rihan</td>
                                        <td style="max-width:100px">REDX Logistics Limited- Sector-4, Uttara</td>
                                        <td>15</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>657</td>
                                        <td style="max-width:100px">Md. Akib</td>
                                        <td style="max-width:100px">Apon Trading.</td>
                                        <td>2</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>658</td>
                                        <td style="max-width:100px">Sabuj Das</td>
                                        <td style="max-width:100px">Heart to Heart Foundation</td>
                                        <td>5</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>661</td>
                                        <td style="max-width:100px">Md Hasan Patowary</td>
                                        <td style="max-width:100px">Net Dunia</td>
                                        <td>200</td>
                                        <td>0</td>
                                        <td>400</td>
                                        <td>0</td>
                                        <td class="fb1">290</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>662</td>
                                        <td style="max-width:100px">Kajol Hossain</td>
                                        <td style="max-width:100px">Bharari Net 2nd</td>
                                        <td>50</td>
                                        <td>0</td>
                                        <td>200</td>
                                        <td>0</td>
                                        <td class="fb1">80</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>663</td>
                                        <td style="max-width:100px">Md. Billal Hossain </td>
                                        <td style="max-width:100px">Palash link technology </td>
                                        <td>50</td>
                                        <td>0</td>
                                        <td>200</td>
                                        <td>0</td>
                                        <td class="fb1">50</td>
                                        <td>0</td>
                                        <td>20</td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>664</td>
                                        <td style="max-width:100px">Rudro Ahmed</td>
                                        <td style="max-width:100px">Rudro Ahmed</td>
                                        <td>1</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>665</td>
                                        <td style="max-width:100px">Md Rezaur Rahman </td>
                                        <td style="max-width:100px">T.G Network</td>
                                        <td>400</td>
                                        <td>0</td>
                                        <td>1000</td>
                                        <td>0</td>
                                        <td class="fb1">600</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>666</td>
                                        <td style="max-width:100px">Sufia Khatun</td>
                                        <td style="max-width:100px">HK Net</td>
                                        <td>1100</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td class="fb1"></td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td>3000</td>
                                    </tr>

                                    <tr>
                                        <td>492</td>
                                        <td style="max-width:100px">Kobirul Islam Litin (Accounts &amp; Admin)</td>
                                        <td style="max-width:100px">Tua - Ha Textiles Ltd.</td>
                                        <td>8</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fb1"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>495</td>
                                        <td style="max-width:100px">Md Atikur Rahaman</td>
                                        <td style="max-width:100px">Shama International Ltd.</td>
                                        <td>2</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fb1"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>496</td>
                                        <td style="max-width:100px">Md Khokon</td>
                                        <td style="max-width:100px">M/S. JOTI FILLING STATION (CNG)</td>
                                        <td>3</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fb1"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>499</td>
                                        <td style="max-width:100px">Engr. Mahabub</td>
                                        <td style="max-width:100px">NS- Prime JVCA</td>
                                        <td>1</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fb1"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>511</td>
                                        <td style="max-width:100px">Liton Head of IT</td>
                                        <td style="max-width:100px">Array International Ltd.</td>
                                        <td>10</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fb1"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>512</td>
                                        <td style="max-width:100px">Liton Head of IT</td>
                                        <td style="max-width:100px">Radial international Ltd.</td>
                                        <td>10</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fb1"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Basic Floating Label Form section end -->

    </div>
</div>
@endsection
