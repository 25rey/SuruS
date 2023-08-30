'use strict';

// エラーメッセージの表示機能
function errorElement(form, msg) {
	form.className = "error-form"; //入力欄のクラス名を"error-form"に
	const newElement = document.createElement("div"); //新たにdiv要素を作成
	newElement.className = "error"; //div要素のクラス名を"errorに
	const newText = document.createTextNode(msg); //エラーメッセージのテキストを代入
	newElement.appendChild(newText); //div要素の中にエラーメッセージを挿入
	form.parentNode.insertBefore(newElement, form.nextSibling); //エラーメッセージをformの後ろに表示
}

// エラーメッセージのクリア機能
function removeElementsByClass(className) {
	const elements = document.getElementsByClassName(className); //該当するクラス名を持つ要素を取得
	while (elements.length > 0) { //配列elementsの要素が1つ以上ある限り
		elements[0].parentNode.removeChild(elements[0]); //先頭の要素を削除する
	}
}

function removeClass(className) {
	const elements = document.getElementsByClassName(className); //該当するクラス名を持つ要素を取得
	while (elements.length > 0) { //配列elementsの要素が1つ以上ある限り
		elements[0].className = ""; //先頭のクラス名を削除する
	}
}
// メールアドレスの形式チェック
function validateMail(email) {
	if (email.match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/) == null) { // match関数は形式に合わない場合、nullを返す
		return true;
	} else {
		return false;
	}
}

// バリデーション
function validate() {
	let flag = true; //フラグのデフォルトはtrue
	removeElementsByClass("error"); //エラーメッセージの削除
	removeClass("error-form"); //class="error-message"を取り除く

	// お名前の入力をチェック
	if (document.form.name.value == "") {
		errorElement(document.form.name, "※お名前が入力されていません");
		flag = false;
	}

	// メールアドレスの入力をチェック
	if (document.form.email.value == "") {
		errorElement(document.form.email, "※メールアドレスが入力されていません");
		flag = false;
	} else if (validateMail(document.form.email.value)) {
		// メールアドレスの形式をチェック
		errorElement(document.form.email, "※メールアドレスが正しくありません");
		flag = false;

	}

	// 電話番号の入力をチェック
	if (document.form.tel.value == "") {
		errorElement(document.form.tel, "※電話番号が入力されていません");
		flag = false;
	}

	// お問い合わせ内容の入力をチェック
	if (document.form.message.value == "") {
		errorElement(document.form.message, "※メッセージが入力されていません");
		flag = false;
	} else if (document.form.message.value.length < 50) {
		// 50文字以上入力されているかチェック
		errorElement(document.form.message, "※メッセージは50文字以上で入力してください");
		flag = false;
	}

	return flag;
}
