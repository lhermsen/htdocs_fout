var hexcase=0;var b64pad="";var chrsz=8;function hex_md5(a){return binl2hex(core_md5(str2binl(a),a.length*chrsz))}function b64_md5(a){return binl2b64(core_md5(str2binl(a),a.length*chrsz))}function str_md5(a){return binl2str(core_md5(str2binl(a),a.length*chrsz))}function hex_hmac_md5(a,b){return binl2hex(core_hmac_md5(a,b))}function b64_hmac_md5(a,b){return binl2b64(core_hmac_md5(a,b))}function str_hmac_md5(a,b){return binl2str(core_hmac_md5(a,b))}function md5_vm_test(){return hex_md5("abc")=="900150983cd24fb0d6963f7d28e17f72"}function core_md5(p,k){p[k>>5]|=128<<((k)%32);p[(((k+64)>>>9)<<4)+14]=k;var o=1732584193;var n=-271733879;var m=-1732584194;var l=271733878;for(var g=0;g<p.length;g+=16){var j=o;var h=n;var f=m;var e=l;o=md5_ff(o,n,m,l,p[g+0],7,-680876936);l=md5_ff(l,o,n,m,p[g+1],12,-389564586);m=md5_ff(m,l,o,n,p[g+2],17,606105819);n=md5_ff(n,m,l,o,p[g+3],22,-1044525330);o=md5_ff(o,n,m,l,p[g+4],7,-176418897);l=md5_ff(l,o,n,m,p[g+5],12,1200080426);m=md5_ff(m,l,o,n,p[g+6],17,-1473231341);n=md5_ff(n,m,l,o,p[g+7],22,-45705983);o=md5_ff(o,n,m,l,p[g+8],7,1770035416);l=md5_ff(l,o,n,m,p[g+9],12,-1958414417);m=md5_ff(m,l,o,n,p[g+10],17,-42063);n=md5_ff(n,m,l,o,p[g+11],22,-1990404162);o=md5_ff(o,n,m,l,p[g+12],7,1804603682);l=md5_ff(l,o,n,m,p[g+13],12,-40341101);m=md5_ff(m,l,o,n,p[g+14],17,-1502002290);n=md5_ff(n,m,l,o,p[g+15],22,1236535329);o=md5_gg(o,n,m,l,p[g+1],5,-165796510);l=md5_gg(l,o,n,m,p[g+6],9,-1069501632);m=md5_gg(m,l,o,n,p[g+11],14,643717713);n=md5_gg(n,m,l,o,p[g+0],20,-373897302);o=md5_gg(o,n,m,l,p[g+5],5,-701558691);l=md5_gg(l,o,n,m,p[g+10],9,38016083);m=md5_gg(m,l,o,n,p[g+15],14,-660478335);n=md5_gg(n,m,l,o,p[g+4],20,-405537848);o=md5_gg(o,n,m,l,p[g+9],5,568446438);l=md5_gg(l,o,n,m,p[g+14],9,-1019803690);m=md5_gg(m,l,o,n,p[g+3],14,-187363961);n=md5_gg(n,m,l,o,p[g+8],20,1163531501);o=md5_gg(o,n,m,l,p[g+13],5,-1444681467);l=md5_gg(l,o,n,m,p[g+2],9,-51403784);m=md5_gg(m,l,o,n,p[g+7],14,1735328473);n=md5_gg(n,m,l,o,p[g+12],20,-1926607734);o=md5_hh(o,n,m,l,p[g+5],4,-378558);l=md5_hh(l,o,n,m,p[g+8],11,-2022574463);m=md5_hh(m,l,o,n,p[g+11],16,1839030562);n=md5_hh(n,m,l,o,p[g+14],23,-35309556);o=md5_hh(o,n,m,l,p[g+1],4,-1530992060);l=md5_hh(l,o,n,m,p[g+4],11,1272893353);m=md5_hh(m,l,o,n,p[g+7],16,-155497632);n=md5_hh(n,m,l,o,p[g+10],23,-1094730640);o=md5_hh(o,n,m,l,p[g+13],4,681279174);l=md5_hh(l,o,n,m,p[g+0],11,-358537222);m=md5_hh(m,l,o,n,p[g+3],16,-722521979);n=md5_hh(n,m,l,o,p[g+6],23,76029189);o=md5_hh(o,n,m,l,p[g+9],4,-640364487);l=md5_hh(l,o,n,m,p[g+12],11,-421815835);m=md5_hh(m,l,o,n,p[g+15],16,530742520);n=md5_hh(n,m,l,o,p[g+2],23,-995338651);o=md5_ii(o,n,m,l,p[g+0],6,-198630844);l=md5_ii(l,o,n,m,p[g+7],10,1126891415);m=md5_ii(m,l,o,n,p[g+14],15,-1416354905);n=md5_ii(n,m,l,o,p[g+5],21,-57434055);o=md5_ii(o,n,m,l,p[g+12],6,1700485571);l=md5_ii(l,o,n,m,p[g+3],10,-1894986606);m=md5_ii(m,l,o,n,p[g+10],15,-1051523);n=md5_ii(n,m,l,o,p[g+1],21,-2054922799);o=md5_ii(o,n,m,l,p[g+8],6,1873313359);l=md5_ii(l,o,n,m,p[g+15],10,-30611744);m=md5_ii(m,l,o,n,p[g+6],15,-1560198380);n=md5_ii(n,m,l,o,p[g+13],21,1309151649);o=md5_ii(o,n,m,l,p[g+4],6,-145523070);l=md5_ii(l,o,n,m,p[g+11],10,-1120210379);m=md5_ii(m,l,o,n,p[g+2],15,718787259);n=md5_ii(n,m,l,o,p[g+9],21,-343485551);o=safe_add(o,j);n=safe_add(n,h);m=safe_add(m,f);l=safe_add(l,e)}return Array(o,n,m,l)}function md5_cmn(h,e,d,c,g,f){return safe_add(bit_rol(safe_add(safe_add(e,h),safe_add(c,f)),g),d)}function md5_ff(g,f,k,j,e,i,h){return md5_cmn((f&k)|((~f)&j),g,f,e,i,h)}function md5_gg(g,f,k,j,e,i,h){return md5_cmn((f&j)|(k&(~j)),g,f,e,i,h)}function md5_hh(g,f,k,j,e,i,h){return md5_cmn(f^k^j,g,f,e,i,h)}function md5_ii(g,f,k,j,e,i,h){return md5_cmn(k^(f|(~j)),g,f,e,i,h)}function core_hmac_md5(c,f){var e=str2binl(c);if(e.length>16){e=core_md5(e,c.length*chrsz)}var a=Array(16),d=Array(16);for(var b=0;b<16;b++){a[b]=e[b]^909522486;d[b]=e[b]^1549556828}var g=core_md5(a.concat(str2binl(f)),512+f.length*chrsz);return core_md5(d.concat(g),512+128)}function safe_add(a,d){var c=(a&65535)+(d&65535);var b=(a>>16)+(d>>16)+(c>>16);return(b<<16)|(c&65535)}function bit_rol(a,b){return(a<<b)|(a>>>(32-b))}function str2binl(d){var c=Array();var a=(1<<chrsz)-1;for(var b=0;b<d.length*chrsz;b+=chrsz){c[b>>5]|=(d.charCodeAt(b/chrsz)&a)<<(b%32)}return c}function binl2str(c){var d="";var a=(1<<chrsz)-1;for(var b=0;b<c.length*32;b+=chrsz){d+=String.fromCharCode((c[b>>5]>>>(b%32))&a)}return d}function binl2hex(c){var b=hexcase?"0123456789ABCDEF":"0123456789abcdef";var d="";for(var a=0;a<c.length*4;a++){d+=b.charAt((c[a>>2]>>((a%4)*8+4))&15)+b.charAt((c[a>>2]>>((a%4)*8))&15)}return d}function binl2b64(d){var c="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";var f="";for(var b=0;b<d.length*4;b+=3){var e=(((d[b>>2]>>8*(b%4))&255)<<16)|(((d[b+1>>2]>>8*((b+1)%4))&255)<<8)|((d[b+2>>2]>>8*((b+2)%4))&255);for(var a=0;a<4;a++){if(b*8+a*6>d.length*32){f+=b64pad}else{f+=c.charAt((e>>6*(3-a))&63)}}}return f}var Aes={};Aes.Cipher=function(e,a){var d=4;var h=a.length/d-1;var g=[[],[],[],[]];for(var f=0;f<4*d;f++){g[f%4][Math.floor(f/4)]=e[f]}g=Aes.AddRoundKey(g,a,0,d);for(var c=1;c<h;c++){g=Aes.SubBytes(g,d);g=Aes.ShiftRows(g,d);g=Aes.MixColumns(g,d);g=Aes.AddRoundKey(g,a,c,d)}g=Aes.SubBytes(g,d);g=Aes.ShiftRows(g,d);g=Aes.AddRoundKey(g,a,h,d);var b=new Array(4*d);for(var f=0;f<4*d;f++){b[f]=g[f%4][Math.floor(f/4)]}return b};Aes.KeyExpansion=function(f){var d=4;var b=f.length/4;var g=b+6;var e=new Array(d*(g+1));var h=new Array(4);for(var c=0;c<b;c++){var a=[f[4*c],f[4*c+1],f[4*c+2],f[4*c+3]];e[c]=a}for(var c=b;c<(d*(g+1));c++){e[c]=new Array(4);for(var j=0;j<4;j++){h[j]=e[c-1][j]}if(c%b==0){h=Aes.SubWord(Aes.RotWord(h));for(var j=0;j<4;j++){h[j]^=Aes.Rcon[c/b][j]}}else{if(b>6&&c%b==4){h=Aes.SubWord(h)}}for(var j=0;j<4;j++){e[c][j]=e[c-b][j]^h[j]}}return e};Aes.SubBytes=function(b,a){for(var d=0;d<4;d++){for(var e=0;e<a;e++){b[d][e]=Aes.Sbox[b[d][e]]}}return b};Aes.ShiftRows=function(d,a){var b=new Array(4);for(var e=1;e<4;e++){for(var f=0;f<4;f++){b[f]=d[e][(f+e)%a]}for(var f=0;f<4;f++){d[e][f]=b[f]}}return d};Aes.MixColumns=function(h,f){for(var j=0;j<4;j++){var e=new Array(4);var d=new Array(4);for(var g=0;g<4;g++){e[g]=h[g][j];d[g]=h[g][j]&128?h[g][j]<<1^283:h[g][j]<<1}h[0][j]=d[0]^e[1]^d[1]^e[2]^e[3];h[1][j]=e[0]^d[1]^e[2]^d[2]^e[3];h[2][j]=e[0]^e[1]^d[2]^e[3]^d[3];h[3][j]=e[0]^d[0]^e[1]^e[2]^d[3]}return h};Aes.AddRoundKey=function(f,a,d,b){for(var e=0;e<4;e++){for(var g=0;g<b;g++){f[e][g]^=a[d*4+g][e]}}return f};Aes.SubWord=function(a){for(var b=0;b<4;b++){a[b]=Aes.Sbox[a[b]]}return a};Aes.RotWord=function(a){var c=a[0];for(var b=0;b<3;b++){a[b]=a[b+1]}a[3]=c;return a};Aes.Sbox=[99,124,119,123,242,107,111,197,48,1,103,43,254,215,171,118,202,130,201,125,250,89,71,240,173,212,162,175,156,164,114,192,183,253,147,38,54,63,247,204,52,165,229,241,113,216,49,21,4,199,35,195,24,150,5,154,7,18,128,226,235,39,178,117,9,131,44,26,27,110,90,160,82,59,214,179,41,227,47,132,83,209,0,237,32,252,177,91,106,203,190,57,74,76,88,207,208,239,170,251,67,77,51,133,69,249,2,127,80,60,159,168,81,163,64,143,146,157,56,245,188,182,218,33,16,255,243,210,205,12,19,236,95,151,68,23,196,167,126,61,100,93,25,115,96,129,79,220,34,42,144,136,70,238,184,20,222,94,11,219,224,50,58,10,73,6,36,92,194,211,172,98,145,149,228,121,231,200,55,109,141,213,78,169,108,86,244,234,101,122,174,8,186,120,37,46,28,166,180,198,232,221,116,31,75,189,139,138,112,62,181,102,72,3,246,14,97,53,87,185,134,193,29,158,225,248,152,17,105,217,142,148,155,30,135,233,206,85,40,223,140,161,137,13,191,230,66,104,65,153,45,15,176,84,187,22];Aes.Rcon=[[0,0,0,0],[1,0,0,0],[2,0,0,0],[4,0,0,0],[8,0,0,0],[16,0,0,0],[32,0,0,0],[64,0,0,0],[128,0,0,0],[27,0,0,0],[54,0,0,0]];var AesCtr={};AesCtr.encrypt=function(j,a,t){var k=16;if(!(t==128||t==192||t==256)){return""}j=Utf8.encode(j);a=Utf8.encode(a);var l=t/8;var f=new Array(l);for(var r=0;r<l;r++){f[r]=isNaN(a.charCodeAt(r))?0:a.charCodeAt(r)}var y=Aes.Cipher(f,Aes.KeyExpansion(f));y=y.concat(y.slice(0,l-16));var e=new Array(k);var s=(new Date()).getTime();var d=Math.floor(s/1000);var g=s%1000;for(var r=0;r<4;r++){e[r]=(d>>>r*8)&255}for(var r=0;r<4;r++){e[r+4]=g&255}var n="";for(var r=0;r<8;r++){n+=String.fromCharCode(e[r])}var v=Aes.KeyExpansion(y);var q=Math.ceil(j.length/k);var m=new Array(q);for(var w=0;w<q;w++){for(var u=0;u<4;u++){e[15-u]=(w>>>u*8)&255}for(var u=0;u<4;u++){e[15-u-4]=(w/4294967296>>>u*8)}var h=Aes.Cipher(e,v);var p=w<q-1?k:(j.length-1)%k+1;var o=new Array(p);for(var r=0;r<p;r++){o[r]=h[r]^j.charCodeAt(w*k+r);o[r]=String.fromCharCode(o[r])}m[w]=o.join("")}var x=n+m.join("");x=Base64.encode(x);return x};AesCtr.decrypt=function(t,e,p){var m=16;if(!(p==128||p==192||p==256)){return""}t=Base64.decode(t);e=Utf8.encode(e);var n=p/8;var j=new Array(n);for(var o=0;o<n;o++){j[o]=isNaN(e.charCodeAt(o))?0:e.charCodeAt(o)}var u=Aes.Cipher(j,Aes.KeyExpansion(j));u=u.concat(u.slice(0,n-16));var f=new Array(8);ctrTxt=t.slice(0,8);for(var o=0;o<8;o++){f[o]=ctrTxt.charCodeAt(o)}var r=Aes.KeyExpansion(u);var g=Math.ceil((t.length-8)/m);var h=new Array(g);for(var s=0;s<g;s++){h[s]=t.slice(8+s*m,8+s*m+m)}t=h;var a=new Array(t.length);for(var s=0;s<g;s++){for(var q=0;q<4;q++){f[15-q]=((s)>>>q*8)&255}for(var q=0;q<4;q++){f[15-q-4]=(((s+1)/4294967296-1)>>>q*8)&255}var l=Aes.Cipher(f,r);var d=new Array(t[s].length);for(var o=0;o<t[s].length;o++){d[o]=l[o]^t[s].charCodeAt(o);d[o]=String.fromCharCode(d[o])}a[s]=d.join("")}var k=a.join("");k=Utf8.decode(k);return k};var Base64={};Base64.code="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";Base64.encode=function(n,p){p=(typeof p=="undefined")?false:p;var g,b,a,r,o,k,j,h,i=[],f="",m,q,l;var d=Base64.code;q=p?n.encodeUTF8():n;m=q.length%3;if(m>0){while(m++<3){f+="=";q+="\0"}}for(m=0;m<q.length;m+=3){g=q.charCodeAt(m);b=q.charCodeAt(m+1);a=q.charCodeAt(m+2);r=g<<16|b<<8|a;o=r>>18&63;k=r>>12&63;j=r>>6&63;h=r&63;i[m/3]=d.charAt(o)+d.charAt(k)+d.charAt(j)+d.charAt(h)}l=i.join("");l=l.slice(0,l.length-f.length)+f;return l};Base64.decode=function(n,e){e=(typeof e=="undefined")?false:e;var g,b,a,o,k,i,h,q,j=[],p,m;var f=Base64.code;m=e?n.decodeUTF8():n;for(var l=0;l<m.length;l+=4){o=f.indexOf(m.charAt(l));k=f.indexOf(m.charAt(l+1));i=f.indexOf(m.charAt(l+2));h=f.indexOf(m.charAt(l+3));q=o<<18|k<<12|i<<6|h;g=q>>>16&255;b=q>>>8&255;a=q&255;j[l/4]=String.fromCharCode(g,b,a);if(h==64){j[l/4]=String.fromCharCode(g,b)}if(i==64){j[l/4]=String.fromCharCode(g)}}p=j.join("");return e?p.decodeUTF8():p};var Utf8={};Utf8.encode=function(a){var b=a.replace(/[\u0080-\u07ff]/g,function(e){var d=e.charCodeAt(0);return String.fromCharCode(192|d>>6,128|d&63)});b=b.replace(/[\u0800-\uffff]/g,function(e){var d=e.charCodeAt(0);return String.fromCharCode(224|d>>12,128|d>>6&63,128|d&63)});return b};Utf8.decode=function(b){var a=b.replace(/[\u00c0-\u00df][\u0080-\u00bf]/g,function(e){var d=(e.charCodeAt(0)&31)<<6|e.charCodeAt(1)&63;return String.fromCharCode(d)});a=a.replace(/[\u00e0-\u00ef][\u0080-\u00bf][\u0080-\u00bf]/g,function(e){var d=((e.charCodeAt(0)&15)<<12)|((e.charCodeAt(1)&63)<<6)|(e.charCodeAt(2)&63);return String.fromCharCode(d)});return a};

function encryptPass() {
	if (document.getElementById('emailadres').value != '' && document.getElementById('wachtwoord').value != '') {
		document.getElementById('wachtwoord_encrypted').value = hex_md5(hex_md5(document.getElementById('emailadres').value.toLowerCase() + document.getElementById('wachtwoord').value) + document.getElementById('challenge').value);
		document.getElementById('challenge').value = '';
		document.getElementById('wachtwoord').value = '';
		return true;
	}
	else if (document.getElementById('emailadres').value == '') {
		alert('Je hebt je e-mailadres nog niet ingevuld.');
		return false;
	}
	else if (document.getElementById('wachtwoord').value == '') {
		alert('Je hebt je wachtwoord nog niet ingevuld.');
		return false;
	}
}

function hashPass() {
	if (document.getElementById('wachtwoord').value != '' && document.getElementById('wachtwoord').value == document.getElementById('wachtwoord_confirm').value) {
		document.getElementById('wachtwoord_hash').value = hex_md5(document.getElementById('emailadres').value.toLowerCase() + document.getElementById('wachtwoord').value);
		document.getElementById('wachtwoord').value = '';
		document.getElementById('wachtwoord_confirm').value = '';
		return true;
	}
	else if (document.getElementById('wachtwoord').value == '') {
		alert('Je hebt nog geen wachtwoord ingevuld.');
		return false;
	}
	else if (document.getElementById('wachtwoord').value != document.getElementById('wachtwoord_confirm').value) {
		alert('De ingevulde wachtwoorden zijn niet hetzelfde.');
		return false;
	}
}

function encryptHashPass() {
	if (document.getElementById('wachtwoord').value != '' && document.getElementById('wachtwoord').value == document.getElementById('wachtwoord_confirm').value) {
		document.getElementById('wachtwoord_encryptedhash').value = AesCtr.encrypt(document.getElementById('wachtwoord').value, document.getElementById('challenge').value, 256);
		document.getElementById('wachtwoord_hash').value = hex_md5(document.getElementById('emailadres').value.toLowerCase() + document.getElementById('wachtwoord').value);
		document.getElementById('challenge').value = '';
		document.getElementById('wachtwoord').value = '';
		document.getElementById('wachtwoord_confirm').value = '';
		return true;
	}
	else if (document.getElementById('wachtwoord').value == '') {
		alert('Je hebt nog geen wachtwoord ingevuld.');
		return false;
	}
	else if (document.getElementById('wachtwoord').value != document.getElementById('wachtwoord_confirm').value) {
		alert('De ingevulde wachtwoorden zijn niet hetzelfde.');
		return false;
	}
}