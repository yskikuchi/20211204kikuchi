@extends('layouts.default')

@section('title','内容確認')
@section('content')
<form action="/thanks" method="POST">
@csrf
    <table>
        <tr>
            <th>
                お名前
            </th>
            <td>
                <input type="hidden" name="family_name" id="name" value="{{ $items['family_name'] }}">
                <input type="hidden" name="first_name" value="{{ $items['first_name'] }}">
                {{$items['family_name']}}  {{$items['first_name']}}
            </td>
        </tr>
    <tr>
        <th>
            性別
        </th>
        <td>
            <input type="hidden" name="gender" id="male" value="{{ $items['gender'] }}">
            @if($items['gender'] == 1)
              男性
            @else
              女性
            @endif
        </td>
    </tr>
    <tr>
        <th>
            メールアドレス
        </th>
        <td>
            <input type="hidden" name="email" id="email" value="{{$items['email']}}">
            {{$items['email']}}
        </td>
    </tr>
    <tr>
        <th>
            郵便番号
        </th>
        <td>
            <input type="hidden" name="postcode" id="postcode" value="{{$items['postcode']}}">
            {{$items['postcode']}}
        </td>
    </tr>
    <tr>
        <th>
            住所
        </th>
        <td>
            <input type="hidden" name="address" id="address" value="{{$items['address']}}">
            {{$items['address']}}
        </td>
    </tr>
    <tr>
        <th>
            建物名
        </th>
        <td>
            <input type="hidden" name="building_name" id="building_name" value="{{$items['building_name']}}">
            {{$items['building_name']}}
        </td>
    </tr>
    <tr>
        <th>
            ご意見
        </th>
        <td>
            <input type="hidden" name="opinion" id="opinion" value="{{$items['opinion']}}">
            {{$items['opinion']}}
        </td>
    </tr>
    </table>
    <button class="submit-btn" type="submit" name="action" value="submit">送信</button>
    <button class="back-btn" type="submit" name="action" value="back">修正する</button>



</form>
<style>
  tr{
    width:70%;
    height:100px;
    font-size:20px;
  }
  th{
    width:30%;
  }
  td{
    text-align:left;
    width:50%;
  }
  label{
    margin-right:10px;
  }
  .name-input{
    height:30px;
    width:40%;
  }
  .gender-input{
    height:50px;
    transform:scale(1.5);
    margin-right:10px;
  }
  .postcode-input{
    height:30px;
    width:50%;
    margin-left:10px;
  }
  .email-input, .address-input, .building-input{
    height:30px;
    width:90%;
  }
  textarea{
    width:90%;
  }
  .submit-btn{
    background-color:black;
    color:white;
    width:120px;
    height:40px;
    margin-top:20px;
    cursor:pointer;
}
.back-btn{
  font-size:15px;
  background:none;
  border:none;
  text-decoration:underline;
  display:block;
  margin:10px auto;
  cursor:pointer;
}
</style>


@endsection