@extends('layouts.default')

@section('title','お問い合わせ')
@section('content')


<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
<form action="/confirm" method="POST">
@csrf
    <table>
        <tr>
            <th>
                <label for="family_name">お名前<span class="required">※</span></label>
            </th>
            <td class="name-wrapper">
                <div>
                    <input class="family-name-input" type="text" name="family_name" id="family_name" value="{{old('family_name')}}">
                    <p>例）山田</p>
                    <span id="error-message-family-name" class="error_message">苗字を入力してください</span>
                    @if($errors->has('family_name'))
                    <span class="validation">{{$errors->first('family_name')}}</span>
                    @endif
                </div>
                <div>
                    <input class="first-name-input" type="text" name="first_name" id="first_name" value="{{old('first_name')}}">
                    <p>例）太郎</p>
                    <span id="error-message-first-name" class="error_message">名前を入力してください</span>
                    @if($errors->has('first_name'))
                    <span class="validation">{{$errors->first('first_name')}}</span>
                    @endif
                </div>
            </td>
        </tr>
    <tr>
        <th>
            <label for="gender">性別<span>※</span></label>
        </th>
        <td>
            <label for="male"><input class="gender-input" type="radio" name="gender" id="male" value=1 checked {{old('gender') == 1 ? 'checked':'';}}>男性</label>
            <label for="female"><input class="gender-input" type="radio" name="gender" id="female" value=2 {{old('gender') == 2 ? 'checked':'';}}>女性</label>
        </td>
    </tr>
    <tr>
        <th>
            <label for="email">メールアドレス<span class="required">※</span></label>
        </th>
        <td>
            <input class="email-input" type="email" name="email" id="email" value="{{old('email')}}">
            <p>例）test@example.com</p>
            <span id="error-message-email-required" class="error_message">メールアドレスを入力してください</span>
            <span id="error-message-email-reg" class="error_message">メールアドレスの形式で入力してください</span>
            @if($errors->has('email'))
            <span class="validation">{{$errors->first('email')}}</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>
            <label for="postcode">郵便番号<span class="required">※</span></label>
        </th>
        <td>
            <span>〒</span><input class="postcode-input" type="tel" name="postcode" id="postcode" value="{{old('postcode')}}" onKeyUp="AjaxZip3.zip2addr('postcode','','address','address');">
            <p>例）123-4567</p>
            <span id="error-message-postcode-required" class="error_message">郵便番号を入力してください</span>
            <span id="error-message-postcode-reg" class="error_message">ハイフンを入れた８文字で入力してください</span>
            @if($errors->has('postcode'))
            <span class="validation">{{$errors->first('postcode')}}</span>
            @endif

        </td>
    </tr>
    <tr>
        <th>
            <label for="address">住所<span class="required">※</span></label>
        </th>
        <td>
            <input class="address-input" type="text" name="address" id="address" value="{{old('address')}}">
            <p>例）東京都渋谷区千駄ヶ谷1-2-3</p>
            <span id="error-message-address" class="error_message">住所を入力してください</span>
            @if($errors->has('address'))
            <span class="validation">{{$errors->first('address')}}</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>
            <label for="building_name">建物名</label>
        </th>
        <td>
            <input class="building-input" type="text" name="building_name" id="building_name" value="{{old('building_name')}}">
            <p>例）千駄ヶ谷マンション101</p>
        </td>
    </tr>
    <tr>
        <th>
            <label for="opinion">ご意見<span class="required">※</span></label>
        </th>
        <td>
            <textarea name="opinion" id="opinion" cols="30" rows="5">{{old('opinion')}}</textarea>
            <span id="error-message-opinion-required" class="error_message">ご意見を入力してください</span>
            <span id="error-message-opinion-limit" class="error_message">120字以内で入力してください</span>
            @if($errors->has('opinion'))
            <span class="validation">{{$errors->first('opinion')}}</span>
            @endif
        </td>
    </tr>
    </table>
    <button class="confirm-btn">確認</button>
</form>

<style>
    tr{
        width:80%;
        height:100px;
        font-size:20px;
        }
    th{
        width:30%;
    }
    td{
        text-align:left;
        width:60%;
    }
    p{
        color:darkgray;
        margin-top:5px;
    }
    label{
        margin-right:10px;
    }
    .required{
        color:red;
    }
    .name-wrapper{
        display:flex;
    }
    .family-name-input{
        height:30px;
        width:200px;
        margin-right:50px;
    }
    .first-name-input{
        height:30px;
        width:200px;
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
    .error_message{
        color:red;
        display:none;
        font-size:18px;
    }
    .validation{
        color:red;
        display:inline-block;
    }
    .confirm-btn{
        background-color:black;
        color:white;
        width:120px;
        height:40px;
        margin-top:20px;
        cursor:pointer;
    }
</style>

<script>

const family_name = document.getElementById("family_name");
const first_name = document.getElementById("first_name");
const email = document.getElementById("email");
const postcode = document.getElementById("postcode");
const address = document.getElementById("address");
const opinion = document.getElementById("opinion");

const error_message_family_name = document.getElementById("error-message-family-name");
const error_message_first_name = document.getElementById("error-message-first-name");
const error_message_email_required = document.getElementById("error-message-email-required");
const error_message_email_reg = document.getElementById("error-message-email-reg");
const error_message_postcode_required = document.getElementById("error-message-postcode-required");
const error_message_postcode_reg = document.getElementById("error-message-postcode-reg");
const error_message_address = document.getElementById("error-message-address");
const error_message_opinion_required = document.getElementById("error-message-opinion-required");
const error_message_opinion_limit = document.getElementById("error-message-opinion-limit");

const emailExp = /^[a-zA-Z0-9_.+-]+@[a-z]+\.[a-z]+$/;
const postcodeExp =/[0-9]{3}-[0-9]{4}$/;

family_name.addEventListener("keyup", () => {
    if(!family_name.value){
        error_message_family_name.style.display = "inline-block";
    }else{
        error_message_family_name.style.display = "none";
    }
})

first_name.addEventListener("keyup", () => {
    if(!first_name.value){
        error_message_first_name.style.display = "inline-block";
    }else{
        error_message_first_name.style.display = "none";
    }
})

email.addEventListener("keyup", () => {
    if(!email.value){
        error_message_email_required.style.display = "inline-block";
        error_message_email_reg.style.display = "none";
    }else if(!emailExp.test(email.value)){
        error_message_email_required.style.display = "none";
        error_message_email_reg.style.display = "inline-block";
    }else {
        error_message_email_required.style.display = "none";
        error_message_email_reg.style.display = "none";
    }
})

postcode.addEventListener("keyup", () => {
    if(!postcode.value){
        error_message_postcode_required.style.display = "inline-block";
        error_message_postcode_reg.style.display = "none";
    }else if(!postcodeExp.test(postcode.value)){
        error_message_postcode_required.style.display = "none";
        error_message_postcode_reg.style.display = "inline-block";
    }else {
        error_message_postcode_required.style.display = "none";
        error_message_postcode_reg.style.display = "none";
    }
})

postcode.addEventListener("focusout", () => {
    let half = postcode.value.replace(/[！-～]/g, function(s){
    return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
    })
    .replace(/[ー]/g, '-');
    postcode.value = half;
    AjaxZip3.zip2addr('postcode','','address','address');
    error_message_postcode_reg.style.display = "none";
})

address.addEventListener("keyup", () => {
    if(!address.value){
        error_message_address.style.display = "inline-block";
    }else{
        error_message_address.style.display = "none";
    }
})

opinion.addEventListener("keyup", () => {
    if(!opinion.value){
        error_message_opinion_required.style.display = "inline-block";
    }else{
        error_message_opinion_required.style.display = "none";
    }

    if(opinion.value.length <= 120){
        error_message_opinion_limit.style.display = "none";
    }else{
        error_message_opinion_limit.style.display = "inline-block";
    }
})



</script>
@endsection




