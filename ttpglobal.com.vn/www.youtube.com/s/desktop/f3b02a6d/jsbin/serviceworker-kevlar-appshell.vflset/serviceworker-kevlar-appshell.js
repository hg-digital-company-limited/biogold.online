'use strict';var aa=typeof Object.defineProperties=="function"?Object.defineProperty:function(a,b,c){if(a==Array.prototype||a==Object.prototype)return a;a[b]=c.value;return a};
function ba(a){a=["object"==typeof globalThis&&globalThis,a,"object"==typeof window&&window,"object"==typeof self&&self,"object"==typeof global&&global];for(var b=0;b<a.length;++b){var c=a[b];if(c&&c.Math==Math)return c}throw Error("Cannot find global object");}
var ca=ba(this);function da(a,b){if(b)a:{var c=ca;a=a.split(".");for(var d=0;d<a.length-1;d++){var e=a[d];if(!(e in c))break a;c=c[e]}a=a[a.length-1];d=c[a];b=b(d);b!=d&&b!=null&&aa(c,a,{configurable:!0,writable:!0,value:b})}}
function ea(a){function b(d){return a.next(d)}
function c(d){return a.throw(d)}
return new Promise(function(d,e){function f(g){g.done?d(g.value):Promise.resolve(g.value).then(b,c).then(f,e)}
f(a.next())})}
function r(a){return ea(a())}
da("globalThis",function(a){return a||ca});
da("Symbol.dispose",function(a){return a?a:Symbol("Symbol.dispose")});
da("Object.values",function(a){return a?a:function(b){var c=[],d;for(d in b)Object.prototype.hasOwnProperty.call(b,d)&&c.push(b[d]);return c}});
da("Array.prototype.includes",function(a){return a?a:function(b,c){var d=this;d instanceof String&&(d=String(d));var e=d.length;c=c||0;for(c<0&&(c=Math.max(c+e,0));c<e;c++){var f=d[c];if(f===b||Object.is(f,b))return!0}return!1}});
da("Object.entries",function(a){return a?a:function(b){var c=[],d;for(d in b)Object.prototype.hasOwnProperty.call(b,d)&&c.push([d,b[d]]);return c}});
function fa(a,b){a instanceof String&&(a+="");var c=0,d=!1,e={next:function(){if(!d&&c<a.length){var f=c++;return{value:b(f,a[f]),done:!1}}d=!0;return{done:!0,value:void 0}}};
e[Symbol.iterator]=function(){return e};
return e}
da("Array.prototype.values",function(a){return a?a:function(){return fa(this,function(b,c){return c})}});
da("String.prototype.matchAll",function(a){return a?a:function(b){if(b instanceof RegExp&&!b.global)throw new TypeError("RegExp passed into String.prototype.matchAll() must have global tag.");var c=new RegExp(b,b instanceof RegExp?void 0:"g"),d=this,e=!1,f={next:function(){if(e)return{value:void 0,done:!0};var g=c.exec(d);if(!g)return e=!0,{value:void 0,done:!0};g[0]===""&&(c.lastIndex+=1);return{value:g,done:!1}}};
f[Symbol.iterator]=function(){return f};
return f}});
da("Promise.prototype.finally",function(a){return a?a:function(b){return this.then(function(c){return Promise.resolve(b()).then(function(){return c})},function(c){return Promise.resolve(b()).then(function(){throw c;
})})}});/*

 Copyright The Closure Library Authors.
 SPDX-License-Identifier: Apache-2.0
*/
var t=this||self;function v(a,b){a=a.split(".");b=b||t;for(var c=0;c<a.length;c++)if(b=b[a[c]],b==null)return null;return b}
function ha(a){var b=typeof a;b=b!="object"?b:a?Array.isArray(a)?"array":b:"null";return b=="array"||b=="object"&&typeof a.length=="number"}
function ja(a,b,c){return a.call.apply(a.bind,arguments)}
function ka(a,b,c){if(!a)throw Error();if(arguments.length>2){var d=Array.prototype.slice.call(arguments,2);return function(){var e=Array.prototype.slice.call(arguments);Array.prototype.unshift.apply(e,d);return a.apply(b,e)}}return function(){return a.apply(b,arguments)}}
function la(a,b,c){la=Function.prototype.bind&&Function.prototype.bind.toString().indexOf("native code")!=-1?ja:ka;return la.apply(null,arguments)}
function w(a,b){a=a.split(".");for(var c=t,d;a.length&&(d=a.shift());)a.length||b===void 0?c[d]&&c[d]!==Object.prototype[d]?c=c[d]:c=c[d]={}:c[d]=b}
function ma(a){return a}
function na(a,b){function c(){}
c.prototype=b.prototype;a.La=b.prototype;a.prototype=new c;a.prototype.constructor=a;a.ub=function(d,e,f){for(var g=Array(arguments.length-2),h=2;h<arguments.length;h++)g[h-2]=arguments[h];return b.prototype[e].apply(d,g)}}
;function oa(a,b){if(Error.captureStackTrace)Error.captureStackTrace(this,oa);else{const c=Error().stack;c&&(this.stack=c)}a&&(this.message=String(a));b!==void 0&&(this.cause=b)}
na(oa,Error);oa.prototype.name="CustomError";const pa=String.prototype.trim?function(a){return a.trim()}:function(a){return/^[\s\xa0]*([\s\S]*?)[\s\xa0]*$/.exec(a)[1]};/*

 Copyright Google LLC
 SPDX-License-Identifier: Apache-2.0
*/
let qa=globalThis.trustedTypes,ra;function sa(){let a=null;if(!qa)return a;try{const b=c=>c;
a=qa.createPolicy("goog#html",{createHTML:b,createScript:b,createScriptURL:b})}catch(b){}return a}
;var ta=class{constructor(a){this.h=a}toString(){return this.h+""}};function ua(a,b=`unexpected value ${a}!`){throw Error(b);}
;function va(a,b){Array.prototype.forEach.call(a,b,void 0)}
function wa(a,b){return Array.prototype.map.call(a,b,void 0)}
function xa(a,b){b=Array.prototype.indexOf.call(a,b,void 0);b>=0&&Array.prototype.splice.call(a,b,1)}
function ya(a,b){for(let c=1;c<arguments.length;c++){const d=arguments[c];if(ha(d)){const e=a.length||0,f=d.length||0;a.length=e+f;for(let g=0;g<f;g++)a[e+g]=d[g]}else a.push(d)}}
;function za(a,b){a.__closure__error__context__984382||(a.__closure__error__context__984382={});a.__closure__error__context__984382.severity=b}
;function Aa(a){var b=v("window.location.href");a==null&&(a='Unknown Error of type "null/undefined"');if(typeof a==="string")return{message:a,name:"Unknown error",lineNumber:"Not available",fileName:b,stack:"Not available"};let c,d;var e=!1;try{c=a.lineNumber||a.line||"Not available"}catch(f){c="Not available",e=!0}try{d=a.fileName||a.filename||a.sourceURL||t.$googDebugFname||b}catch(f){d="Not available",e=!0}b=Ba(a);if(!(!e&&a.lineNumber&&a.fileName&&a.stack&&a.message&&a.name)){e=a.message;if(e==
null){if(a.constructor&&a.constructor instanceof Function){if(a.constructor.name)e=a.constructor.name;else if(e=a.constructor,Ca[e])e=Ca[e];else{e=String(e);if(!Ca[e]){const f=/function\s+([^\(]+)/m.exec(e);Ca[e]=f?f[1]:"[Anonymous]"}e=Ca[e]}e='Unknown Error of type "'+e+'"'}else e="Unknown Error of unknown type";typeof a.toString==="function"&&Object.prototype.toString!==a.toString&&(e+=": "+a.toString())}return{message:e,name:a.name||"UnknownError",lineNumber:c,fileName:d,stack:b||"Not available"}}return{message:a.message,
name:a.name,lineNumber:a.lineNumber,fileName:a.fileName,stack:b}}
function Ba(a,b){b||(b={});b[Da(a)]=!0;let c=a.stack||"";var d=a.cause;d&&!b[Da(d)]&&(c+="\nCaused by: ",d.stack&&d.stack.indexOf(d.toString())==0||(c+=typeof d==="string"?d:d.message+"\n"),c+=Ba(d,b));a=a.errors;if(Array.isArray(a)){d=1;let e;for(e=0;e<a.length&&!(d>4);e++)b[Da(a[e])]||(c+="\nInner error "+d++ +": ",a[e].stack&&a[e].stack.indexOf(a[e].toString())==0||(c+=typeof a[e]==="string"?a[e]:a[e].message+"\n"),c+=Ba(a[e],b));e<a.length&&(c+="\n... "+(a.length-e)+" more inner errors")}return c}
function Da(a){let b="";typeof a.toString==="function"&&(b=""+a);return b+a.stack}
var Ca={};var Ea=RegExp("^(?:([^:/?#.]+):)?(?://(?:([^\\\\/?#]*)@)?([^\\\\/?#]*?)(?::([0-9]+))?(?=[\\\\/?#]|$))?([^?#]+)?(?:\\?([^#]*))?(?:#([\\s\\S]*))?$");function Fa(a){return a?decodeURI(a):a}
function Ga(a,b,c){if(Array.isArray(b))for(let d=0;d<b.length;d++)Ga(a,String(b[d]),c);else b!=null&&c.push(a+(b===""?"":"="+encodeURIComponent(String(b))))}
function Ha(a){const b=[];for(const c in a)Ga(c,a[c],b);return b.join("&")}
;function Ia(){throw Error("Invalid UTF8");}
function Ja(a,b){b=String.fromCharCode.apply(null,b);return a==null?b:a+b}
let Ka=void 0,La;const Ma=typeof TextDecoder!=="undefined";function Na(a){t.setTimeout(()=>{throw a;},0)}
;var Oa,Pa=v("CLOSURE_FLAGS"),Qa=Pa&&Pa[610401301];Oa=Qa!=null?Qa:!1;function Ra(){var a=t.navigator;return a&&(a=a.userAgent)?a:""}
var Sa;const Ta=t.navigator;Sa=Ta?Ta.userAgentData||null:null;function Ua(a){if(!Oa||!Sa)return!1;for(let b=0;b<Sa.brands.length;b++){const {brand:c}=Sa.brands[b];if(c&&c.indexOf(a)!=-1)return!0}return!1}
function x(a){return Ra().indexOf(a)!=-1}
;function Va(){return Oa?!!Sa&&Sa.brands.length>0:!1}
;var Wa=x("Safari")&&!((Va()?Ua("Chromium"):(x("Chrome")||x("CriOS"))&&(Va()||!x("Edge"))||x("Silk"))||(Va()?0:x("Coast"))||(Va()?0:x("Opera"))||(Va()?0:x("Edge"))||(Va()?Ua("Microsoft Edge"):x("Edg/"))||(Va()?Ua("Opera"):x("OPR"))||x("Firefox")||x("FxiOS")||x("Silk")||x("Android"))&&!(x("iPhone")&&!x("iPod")&&!x("iPad")||x("iPad")||x("iPod"));var Xa={},Ya=null;function Za(a,b){b===void 0&&(b=0);$a();b=Xa[b];const c=Array(Math.floor(a.length/3)),d=b[64]||"";let e=0,f=0;for(;e<a.length-2;e+=3){var g=a[e],h=a[e+1],k=a[e+2],l=b[g>>2];g=b[(g&3)<<4|h>>4];h=b[(h&15)<<2|k>>6];k=b[k&63];c[f++]=""+l+g+h+k}l=0;k=d;switch(a.length-e){case 2:l=a[e+1],k=b[(l&15)<<2]||d;case 1:a=a[e],c[f]=""+b[a>>2]+b[(a&3)<<4|l>>4]+k+d}return c.join("")}
function ab(a){const b=a.length;let c=b*3/4;c%3?c=Math.floor(c):"=.".indexOf(a[b-1])!=-1&&(c="=.".indexOf(a[b-2])!=-1?c-2:c-1);const d=new Uint8Array(c);let e=0;bb(a,function(f){d[e++]=f});
return e!==c?d.subarray(0,e):d}
function bb(a,b){function c(e){for(;d<a.length;){const f=a.charAt(d++),g=Ya[f];if(g!=null)return g;if(!/^[\s\xa0]*$/.test(f))throw Error("Unknown base64 encoding at char: "+f);}return e}
$a();let d=0;for(;;){const e=c(-1),f=c(0),g=c(64),h=c(64);if(h===64&&e===-1)break;b(e<<2|f>>4);g!=64&&(b(f<<4&240|g>>2),h!=64&&b(g<<6&192|h))}}
function $a(){if(!Ya){Ya={};var a="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789".split(""),b=["+/=","+/","-_=","-_.","-_"];for(let c=0;c<5;c++){const d=a.concat(b[c].split(""));Xa[c]=d;for(let e=0;e<d.length;e++){const f=d[e];Ya[f]===void 0&&(Ya[f]=e)}}}}
;var cb=typeof Uint8Array!=="undefined",db=!(Va()?0:x("Trident")||x("MSIE"))&&typeof btoa==="function";function eb(a){if(!db)return Za(a);let b="",c=0;const d=a.length-10240;for(;c<d;)b+=String.fromCharCode.apply(null,a.subarray(c,c+=10240));b+=String.fromCharCode.apply(null,c?a.subarray(c):a);return btoa(b)}
const fb=/[-_.]/g,gb={"-":"+",_:"/",".":"="};function hb(a){return gb[a]||""}
function ib(a){if(!db)return ab(a);fb.test(a)&&(a=a.replace(fb,hb));a=atob(a);const b=new Uint8Array(a.length);for(let c=0;c<a.length;c++)b[c]=a.charCodeAt(c);return b}
function jb(a){return cb&&a!=null&&a instanceof Uint8Array}
var kb={};function lb(){return mb||(mb=new nb(null,kb))}
function ob(a){pb(kb);var b=a.h;b=b==null||jb(b)?b:typeof b==="string"?ib(b):null;return b==null?b:a.h=b}
var nb=class{sizeBytes(){const a=ob(this);return a?a.length:0}constructor(a,b){pb(b);this.h=a;if(a!=null&&a.length===0)throw Error("ByteString should be constructed with non-empty values");}};let mb;function pb(a){if(a!==kb)throw Error("illegal external caller");}
;let qb=void 0;function rb(a){a=Error(a);za(a,"warning");return a}
function sb(a){if(a!=null){var b;var c=(b=qb)!=null?b:qb={};b=c[a]||0;b>=5||(c[a]=b+1,a=Error(),za(a,"incident"),Na(a))}}
;var tb=typeof Symbol==="function"&&typeof Symbol()==="symbol";function ub(a,b,c=!1){return typeof Symbol==="function"&&typeof Symbol()==="symbol"?c&&Symbol.for&&a?Symbol.for(a):a!=null?Symbol(a):Symbol():b}
var vb=ub("jas",void 0,!0),wb=ub(void 0,"1oa"),xb=ub(void 0,Symbol()),yb=ub(void 0,"0actk"),zb=ub(void 0,"8utk");[...Object.values({eb:1,cb:2,bb:4,jb:8,ib:16,hb:32,Ra:64,pb:128,Za:256,Ya:512,Wa:1024,ob:2048,Xa:4096,Ua:8192,ab:16384})];const z=tb?vb:"Fa",Ab={Fa:{value:0,configurable:!0,writable:!0,enumerable:!1}},Bb=Object.defineProperties;function Cb(a,b){tb||z in a||Bb(a,Ab);a[z]|=b}
function A(a,b){tb||z in a||Bb(a,Ab);a[z]=b}
function Db(a,b){a[z]&=~b}
;var Eb={};function Fb(a){return a!==null&&typeof a==="object"&&!Array.isArray(a)&&a.constructor===Object}
var Gb;const Hb=[];A(Hb,55);Gb=Object.freeze(Hb);function Ib(a){if(a&2)throw Error();}
var Jb=Object.freeze({});function Kb(a,b,c){const d=b&512?0:-1,e=a.length;b=b&64?b&256:!!e&&Fb(a[e-1]);const f=e+(b?-1:0);for(let g=0;g<f;g++)c(g-d,a[g]);if(b){a=a[e-1];for(const g in a)!isNaN(g)&&c(+g,a[g])}}
;function Lb(){return typeof BigInt==="function"}
;function Mb(a){a.Bb=!0;return a}
;var Nb=Mb(a=>typeof a==="number"),Ob=Mb(a=>typeof a==="string"),Pb=Mb(a=>typeof a==="boolean"),Qb=Mb(a=>a!=null&&typeof a==="object"&&typeof a.then==="function");var Rb=typeof t.BigInt==="function"&&typeof t.BigInt(0)==="bigint";var Yb=Mb(a=>Rb?a>=Sb&&a<=Tb:a[0]==="-"?Ub(a,Vb):Ub(a,Wb));
const Vb=Number.MIN_SAFE_INTEGER.toString(),Sb=Rb?BigInt(Number.MIN_SAFE_INTEGER):void 0,Wb=Number.MAX_SAFE_INTEGER.toString(),Tb=Rb?BigInt(Number.MAX_SAFE_INTEGER):void 0;function Ub(a,b){if(a.length>b.length)return!1;if(a.length<b.length||a===b)return!0;for(let c=0;c<a.length;c++){const d=a[c],e=b[c];if(d>e)return!1;if(d<e)return!0}}
;const Zb=typeof Uint8Array.prototype.slice==="function";let C=0,D=0;function $b(a){const b=a>>>0;C=b;D=(a-b)/4294967296>>>0}
function ac(a){if(a<0){$b(0-a);const [b,c]=bc(C,D);C=b>>>0;D=c>>>0}else $b(a)}
function cc(a,b){b>>>=0;a>>>=0;if(b<=2097151)var c=""+(4294967296*b+a);else Lb()?c=""+(BigInt(b)<<BigInt(32)|BigInt(a)):(c=(a>>>24|b<<8)&16777215,b=b>>16&65535,a=(a&16777215)+c*6777216+b*6710656,c+=b*8147497,b*=2,a>=1E7&&(c+=a/1E7>>>0,a%=1E7),c>=1E7&&(b+=c/1E7>>>0,c%=1E7),c=b+dc(c)+dc(a));return c}
function dc(a){a=String(a);return"0000000".slice(a.length)+a}
function bc(a,b){b=~b;a?a=~a+1:b+=1;return[a,b]}
;const ec=typeof BigInt==="function"?BigInt.asIntN:void 0,fc=Number.isSafeInteger,gc=Number.isFinite,hc=Math.trunc;function ic(a){return a.displayName||a.name||"unknown type name"}
const jc=/^-?([1-9][0-9]*|0)(\.[0-9]+)?$/;function kc(a){switch(typeof a){case "bigint":return!0;case "number":return gc(a);case "string":return jc.test(a);default:return!1}}
function lc(a){if(a!=null){if(!gc(a))throw rb("enum");a|=0}return a}
function mc(a){if(typeof a!=="number")throw rb("int32");if(!gc(a))throw rb("int32");return a|0}
function nc(a){if(a==null)return a;if(typeof a==="string"&&a)a=+a;else if(typeof a!=="number")return;return gc(a)?a|0:void 0}
function oc(a){if(!kc(a))throw rb("int64");switch(typeof a){case "string":kc(a);var b=hc(Number(a));if(fc(b))a=String(b);else if(b=a.indexOf("."),b!==-1&&(a=a.substring(0,b)),b=a.length,!(a[0]==="-"?b<20||b===20&&Number(a.substring(0,7))>-922337:b<19||b===19&&Number(a.substring(0,6))<922337)){if(a.length<16)ac(Number(a));else if(Lb())a=BigInt(a),C=Number(a&BigInt(4294967295))>>>0,D=Number(a>>BigInt(32)&BigInt(4294967295));else{b=+(a[0]==="-");D=C=0;var c=a.length;for(let e=0+b,f=(c-b)%6+b;f<=c;e=
f,f+=6){var d=Number(a.slice(e,f));D*=1E6;C=C*1E6+d;C>=4294967296&&(D+=Math.trunc(C/4294967296),D>>>=0,C>>>=0)}if(b){const [e,f]=bc(C,D);C=e;D=f}}a=C;b=D;if(b&2147483648)if(Lb())a=""+(BigInt(b|0)<<BigInt(32)|BigInt(a>>>0));else{const [e,f]=bc(a,b);a="-"+cc(e,f)}else a=cc(a,b)}return a;case "bigint":b=a=ec(64,a);if(Ob(b)){if(!/^\s*(?:-?[1-9]\d*|0)?\s*$/.test(b))throw Error(String(b));}else if(Nb(b)&&!Number.isSafeInteger(b))throw Error(String(b));Rb?a=BigInt(a):a=Pb(a)?a?"1":"0":Ob(a)?a.trim()||"0":
String(a);return a;default:kc(a);a=hc(a);if(!fc(a)){ac(a);b=C;c=D;if(a=c&2147483648)b=~b+1>>>0,c=~c>>>0,b==0&&(c=c+1>>>0);d=c*4294967296+(b>>>0);b=Number.isSafeInteger(d)?d:cc(b,c);a=typeof b==="number"?a?-b:b:a?"-"+b:b}return a}}
function pc(a){if(a!=null&&typeof a!=="string")throw Error();return a}
function qc(a,b){if(!(a instanceof b))throw Error(`Expected instanceof ${ic(b)} but got ${a&&ic(a.constructor)}`);return a}
function rc(a,b,c){if(a!=null&&typeof a==="object"&&a.T===Eb)return a;if(Array.isArray(a)){var d=a[z]|0,e=d;e===0&&(e|=c&32);e|=c&2;e!==d&&A(a,e);return new b(a)}}
;function sc(a){return a}
;function tc(a){const b=ma(xb);return b?a[b]:void 0}
function uc(a,b){for(const c in a)!isNaN(c)&&b(a,+c,a[c])}
function vc(a){const b=new wc;uc(a,(c,d,e)=>{b[d]=e.slice()});
b.h=a.h;return b}
var wc=class{};function xc(a,b,c,d,e){const f=d?!!(b&32):void 0;d=[];var g=a.length;let h,k,l,p=!1;if(b&64){if(b&256?(g--,h=a[g],k=g):(k=4294967295,h=void 0),!(e||b&512)){p=!0;var n;l=((n=yc)!=null?n:sc)(h?k- -1:b>>15&1023||536870912,-1,a,h);k=l+-1}}else k=4294967295,b&1||(h=g&&a[g-1],Fb(h)?(g--,k=g,l=0):h=void 0);n=void 0;for(let m=0;m<g;m++){let u=a[m];if(u!=null&&(u=c(u,f))!=null)if(m>=k){var q=void 0;((q=n)!=null?q:n={})[m- -1]=u}else d[m]=u}if(h)for(let m in h)if(q=h[m],q!=null&&(q=c(q,f))!=null)if(g=+m,g<
l)d[g+-1]=q;else{let u;((u=n)!=null?u:n={})[m]=q}n&&(p?d.push(n):d[k]=n);e&&(A(d,b&33522241|(n!=null?290:34)),ma(xb)&&(a=tc(a))&&a instanceof wc&&(d[xb]=vc(a)));return d}
function zc(a){switch(typeof a){case "number":return Number.isFinite(a)?a:""+a;case "bigint":return Yb(a)?Number(a):""+a;case "boolean":return a?1:0;case "object":if(Array.isArray(a)){var b=a[z]|0;return a.length===0&&b&1?void 0:xc(a,b,zc,!1,!1)}if(a.T===Eb)return Ac(a);if(a instanceof nb)return b=a.h,b==null?"":typeof b==="string"?b:a.h=eb(b);if(jb(a))return jb(a)&&sb(zb),eb(a);return}return a}
let yc;function Ac(a){a=a.o;return xc(a,a[z]|0,zc,void 0,!1)}
;let Bc,Cc;function Dc(a){switch(typeof a){case "boolean":return Bc||(Bc=[0,void 0,!0]);case "number":return a>0?void 0:a===0?Cc||(Cc=[0,void 0]):[-a,void 0];case "string":return[0,a];case "object":return a}}
function Ec(a,b,c){a=Fc(a,b[0],b[1],c?1:2);b!==Bc&&c&&Cb(a,8192);return a}
function Fc(a,b,c,d){if(a==null){var e=96;c?(a=[c],e|=512):a=[];b&&(e=e&-33521665|(b&1023)<<15)}else{if(!Array.isArray(a))throw Error("narr");e=a[z]|0;8192&e||!(64&e)||2&e||Gc();if(e&1024)throw Error("farr");if(e&64)return d!==3||e&16384||A(a,e|16384),a;d===1||d===2||(e|=64);if(c&&(e|=512,c!==a[0]))throw Error("mid");a:{c=a;var f=c.length;if(f){var g=f-1;const k=c[g];if(Fb(k)){e|=256;b=e&512?0:-1;g-=b;if(g>=1024)throw Error("pvtlmt");for(var h in k)f=+h,f<g&&(c[f+b]=k[h],delete k[h]);e=e&-33521665|
(g&1023)<<15;break a}}if(b){h=Math.max(b,f-(e&512?0:-1));if(h>1024)throw Error("spvt");e=e&-33521665|(h&1023)<<15}}}d===3&&(e|=16384);A(a,e);return a}
function Gc(){sb(yb)}
;function Hc(a,b){if(typeof a!=="object")return a;if(Array.isArray(a)){const d=a[z]|0;if(a.length===0&&d&1)return;if(d&2)return a;var c;if(c=b)c=d===0||!!(d&32)&&!(d&64||!(d&16));return c?(Cb(a,34),d&4&&Object.freeze(a),a):xc(a,d,Hc,b!==void 0,!0)}if(a.T===Eb)return b=a.o,c=b[z]|0,c&2?a:xc(b,c,Hc,!0,!0);if(a instanceof nb)return a;if(jb(a))return jb(a)&&sb(zb),new Uint8Array(a)}
function Ic(a){const b=a.o;if(!((b[z]|0)&2))return a;a=new a.constructor(xc(b,b[z]|0,Hc,!0,!0));Db(a.o,2);return a}
;function Jc(a,b){a=a.o;return Kc(a,a[z]|0,b)}
function Kc(a,b,c){if(c===-1)return null;const d=c+(b&512?0:-1),e=a.length-1;if(d>=e&&b&256)return a[e][c];if(d<=e)return a[d]}
function E(a,b,c){const d=a.o;let e=d[z]|0;Ib(e);F(d,e,b,c);return a}
function F(a,b,c,d){const e=b&512?0:-1,f=c+e;var g=a.length-1;if(f>=g&&b&256)return a[g][c]=d,b;if(f<=g)return a[f]=d,b;d!==void 0&&(g=b>>15&1023||536870912,c>=g?d!=null&&(a[g+e]={[c]:d},b|=256,A(a,b)):a[f]=d);return b}
function Lc(a,b,c){a=Kc(a,b,c);return Array.isArray(a)?a:Gb}
function Mc(a,b){a===0&&(a=Nc(a,b));return a|1}
function Oc(a){return!!(2&a)&&!!(4&a)||!!(1024&a)}
function Pc(a,b,c,d){const e=a.o;var f=e[z]|0;Ib(f);if(d==null){var g=Qc(e);if(Rc(g,e,f,c)===b)g.set(c,0);else return a}else{c.includes(b);g=Qc(e);const h=Rc(g,e,f,c);h!==b&&(h&&(f=F(e,f,h)),g.set(c,b))}F(e,f,b,d);return a}
function Qc(a){if(tb){var b;return(b=a[wb])!=null?b:a[wb]=new Map}if(wb in a)return a[wb];b=new Map;Object.defineProperty(a,wb,{value:b});return b}
function Rc(a,b,c,d){let e=a.get(d);if(e!=null)return e;e=0;for(let f=0;f<d.length;f++){const g=d[f];Kc(b,c,g)!=null&&(e!==0&&(c=F(b,c,e)),e=g)}a.set(d,e);return e}
function Sc(a,b,c){let d=a[z]|0;const e=Kc(a,d,c);let f;if(e!=null&&e.T===Eb)return b=Ic(e),b!==e&&F(a,d,c,b),b.o;if(Array.isArray(e)){const g=e[z]|0;g&2?(f=Ec(xc(e,g,Hc,!0,!0),b,!0),Db(f,2)):g&64?f=e:f=Ec(f,b,!0)}else f=Ec(void 0,b,!0);f!==e&&F(a,d,c,f);return f}
function Tc(a,b,c){var d=a.o,e=d[z]|0,f=Kc(d,e,c);b=rc(f,b,e);b!==f&&b!=null&&F(d,e,c,b);d=b;if(d==null)return d;a=a.o;e=a[z]|0;e&2||(f=Ic(d),f!==d&&(d=f,F(a,e,c,d)));return d}
function Uc(a,b,c,d,e,f,g){a=a.o;var h=!!(2&b);const k=h?1:e;f=!!f;g&&(g=!h);e=Lc(a,b,d);var l=e[z]|0;h=!!(4&l);if(!h){l=Mc(l,b);var p=e,n=b;const q=!!(2&l);q&&(n|=2);let m=!q,u=!0,B=0,y=0;for(;B<p.length;B++){const G=rc(p[B],c,n);if(G instanceof c){if(!q){const ia=!!((G.o[z]|0)&2);m&&(m=!ia);u&&(u=ia)}p[y++]=G}}y<B&&(p.length=y);l|=4;l=u?l|16:l&-17;l=m?l|8:l&-9;A(p,l);q&&Object.freeze(p)}if(g&&!(8&l||!e.length&&(k===1||k===4&&32&l))){Oc(l)&&(e=Array.prototype.slice.call(e),l=Nc(l,b),b=F(a,b,d,e));
c=e;g=l;for(p=0;p<c.length;p++)l=c[p],n=Ic(l),l!==n&&(c[p]=n);g|=8;g=c.length?g&-17:g|16;A(c,g);l=g}k===1||k===4&&32&l?Oc(l)||(b=l,l|=!e.length||16&l&&(!h||32&l)?2:1024,l!==b&&A(e,l),Object.freeze(e)):(k===2&&Oc(l)&&(e=Array.prototype.slice.call(e),l=Nc(l,b),l=Vc(l,b,f),A(e,l),b=F(a,b,d,e)),Oc(l)||(d=l,l=Vc(l,b,f),l!==d&&A(e,l)));return e}
function H(a,b,c,d){d!=null?qc(d,b):d=void 0;return E(a,c,d)}
function Nc(a,b){a=(2&b?a|2:a&-3)|32;return a&=-1025}
function Vc(a,b,c){32&b&&c||(a&=-33);return a}
function Wc(a,b,c,d){const e=a.o[z]|0;Ib(e);a=Uc(a,e,c,b,2,!0);d=d!=null?qc(d,c):new c;a.push(d);(d.o[z]|0)&2?Db(a,8):Db(a,16)}
function I(a,b){a=Jc(a,b);return a==null||typeof a==="string"?a:void 0}
function Xc(a,b){let c;return(c=I(a,b))!=null?c:""}
function Yc(a,b){var c=Zc;const d=a.o;c=Rc(Qc(d),d,d[z]|0,c);return I(a,c===b?b:-1)}
function J(a,b,c){return E(a,b,pc(c))}
;function $c(a,b){return Error(`Invalid wire type: ${a} (at position ${b})`)}
function ad(){return Error("Failed to read varint, encoding is invalid.")}
function bd(a,b){return Error(`Tried to read past the end of the data ${b} > ${a}`)}
;function cd(a){if(typeof a==="string")return{buffer:ib(a),J:!1};if(Array.isArray(a))return{buffer:new Uint8Array(a),J:!1};if(a.constructor===Uint8Array)return{buffer:a,J:!1};if(a.constructor===ArrayBuffer)return{buffer:new Uint8Array(a),J:!1};if(a.constructor===nb)return{buffer:ob(a)||new Uint8Array(0),J:!0};if(a instanceof Uint8Array)return{buffer:new Uint8Array(a.buffer,a.byteOffset,a.byteLength),J:!1};throw Error("Type not convertible to a Uint8Array, expected a Uint8Array, an ArrayBuffer, a base64 encoded string, a ByteString or an Array of numbers");
}
;function dd(a){const b=a.j;let c=a.h,d=b[c++],e=d&127;if(d&128&&(d=b[c++],e|=(d&127)<<7,d&128&&(d=b[c++],e|=(d&127)<<14,d&128&&(d=b[c++],e|=(d&127)<<21,d&128&&(d=b[c++],e|=d<<28,d&128&&b[c++]&128&&b[c++]&128&&b[c++]&128&&b[c++]&128&&b[c++]&128)))))throw ad();ed(a,c);return e}
function ed(a,b){a.h=b;if(b>a.i)throw bd(a.i,b);}
function fd(a,b){if(b<0)throw Error(`Tried to read a negative byte length: ${b}`);const c=a.h,d=c+b;if(d>a.i)throw bd(b,a.i-c);a.h=d;return c}
var gd=class{constructor(a,b,c,d){this.j=null;this.m=!1;this.h=this.i=this.l=0;this.init(a,b,c,d)}init(a,b,c,{Y:d=!1}={}){this.Y=d;a&&(a=cd(a),this.j=a.buffer,this.m=a.J,this.l=b||0,this.i=c!==void 0?this.l+c:this.j.length,this.h=this.l)}clear(){this.j=null;this.m=!1;this.h=this.i=this.l=0;this.Y=!1}reset(){this.h=this.l}},hd=[];function id(a,b,c,d){if(jd.length){const e=jd.pop();kd(e,d);e.h.init(a,b,c,d);return e}return new ld(a,b,c,d)}
function kd(a,{ia:b=!1}={}){a.ia=b}
function md(a){a.h.clear();a.l=-1;a.i=-1;jd.length<100&&jd.push(a)}
function nd(a){var b=a.h;if(b.h==b.i)return!1;a.j=a.h.h;var c=dd(a.h)>>>0;b=c>>>3;c&=7;if(!(c>=0&&c<=5))throw $c(c,a.j);if(b<1)throw Error(`Invalid field number: ${b} (at position ${a.j})`);a.l=b;a.i=c;return!0}
function od(a){switch(a.i){case 0:if(a.i!=0)od(a);else a:{a=a.h;var b=a.h;const c=b+10,d=a.j;for(;b<c;)if((d[b++]&128)===0){ed(a,b);break a}throw ad();}break;case 1:a=a.h;ed(a,a.h+8);break;case 2:a.i!=2?od(a):(b=dd(a.h)>>>0,a=a.h,ed(a,a.h+b));break;case 5:a=a.h;ed(a,a.h+4);break;case 3:b=a.l;do{if(!nd(a))throw Error("Unmatched start-group tag: stream EOF");if(a.i==4){if(a.l!=b)throw Error("Unmatched end-group tag");break}od(a)}while(1);break;default:throw $c(a.i,a.j);}}
function pd(a,b,c){const d=a.h.i,e=dd(a.h)>>>0,f=a.h.h+e;let g=f-d;g<=0&&(a.h.i=f,c(b,a,void 0,void 0,void 0),g=f-a.h.h);if(g)throw Error("Message parsing ended unexpectedly. Expected to read "+`${e} bytes, instead read ${e-g} bytes, either the `+"data ended unexpectedly or the message misreported its own length");a.h.h=f;a.h.i=d}
var ld=class{constructor(a,b,c,d){if(hd.length){const e=hd.pop();e.init(a,b,c,d);a=e}else a=new gd(a,b,c,d);this.h=a;this.j=this.h.h;this.i=this.l=-1;kd(this,d)}reset(){this.h.reset();this.j=this.h.h;this.i=this.l=-1}},jd=[];var K=class{constructor(a,b,c){this.o=Fc(a,b,c,3)}toJSON(){return Ac(this)}clone(){var a=this;const b=a.o;a=new a.constructor(xc(b,b[z]|0,Hc,!0,!0));Db(a.o,2);return a}J(){return!!((this.o[z]|0)&2)}};K.prototype.T=Eb;function qd(){const a=class{constructor(){throw Error();}};Object.setPrototypeOf(a,a.prototype);return a}
var rd=qd();var sd=class{constructor(a,b){this.W=a;a=ma(rd);this.h=!!a&&b===a||!1}};const td=new sd(function(a,b,c,d,e){if(a.i!==2)return!1;pd(a,Sc(b,d,c),e);return!0},rd),ud=new sd(function(a,b,c,d,e){if(a.i!==2)return!1;
pd(a,Sc(b,d,c),e);return!0},rd);
var vd=Symbol(),wd=Symbol(),xd=Symbol();let yd,zd;
function Ad(a){var b=Bd,c=Cd,d=a[vd];if(d)return d;d={};d.wa=a;d.ca=Dc(a[0]);var e=a[1];let f=1;e&&e.constructor===Object&&(d.extensions=e,e=a[++f],typeof e==="function"&&(d.Ga=!0,yd!=null||(yd=e),zd!=null||(zd=a[f+1]),e=a[f+=2]));const g={};for(;e&&Array.isArray(e)&&e.length&&typeof e[0]==="number"&&e[0]>0;){for(var h=0;h<e.length;h++)g[e[h]]=e;e=a[++f]}for(h=1;e!==void 0;){typeof e==="number"&&(h+=e,e=a[++f]);let p;var k=void 0;e instanceof sd?p=e:(p=td,f--);let n;if((n=p)==null?0:n.h){e=a[++f];
k=a;var l=f;typeof e==="function"&&(e=e(),k[l]=e);k=e}e=a[++f];l=h+1;typeof e==="number"&&e<0&&(l-=e,e=a[++f]);for(;h<l;h++){const q=g[h];k?c(d,h,p,k,q):b(d,h,p,q)}}return a[vd]=d}
;function Bd(a,b,c,d){const e=c.W;a[b]=d?(f,g,h)=>e(f,g,h,d):e}
function Cd(a,b,c,d,e){const f=c.W;let g,h;a[b]=(k,l,p)=>f(k,l,p,h||(h=Ad(d).ca),g||(g=Dd(d)),e)}
function Dd(a){let b=a[wd];if(b!=null)return b;const c=Ad(a);b=c.Ga?(d,e)=>yd(d,e,c):(d,e)=>{const f=d[z]|0;
for(;nd(e)&&e.i!=4;){var g=e.l,h=c[g];if(h==null){var k=c.extensions;k&&(k=k[g])&&(k=Ed(k),k!=null&&(h=c[g]=k))}if(h==null||!h(e,d,g)){k=e;h=k.j;od(k);if(k.ia)var l=void 0;else{var p=k.h.h-h;k.h.h=h;k=k.h;h=p;if(h==0)l=lb();else{var n=fd(k,h);k.Y&&k.m?h=k.j.subarray(n,n+h):(k=k.j,p=n,h=n+h,h=p===h?new Uint8Array(0):Zb?k.slice(p,h):new Uint8Array(k.subarray(p,h)));l=h.length==0?lb():new nb(h,kb)}}p=k=h=void 0;n=d;l&&((h=(k=(p=n[xb])!=null?p:n[xb]=new wc)[g])!=null?h:k[g]=[]).push(l)}}if(e=tc(d))e.h=
c.wa[xd];f&8192&&Cb(d,34);return!0};
a[wd]=b;a[xd]=Fd.bind(a);return b}
function Fd(a,b,c){const d=this[vd],e=this[wd],f=Ec(void 0,d.ca,!1),g=tc(a);if(g){var h=!1,k=d.extensions;if(k&&(g==null||uc(g,(l,p,n)=>{if(n.length!==0)if(k[p])for(const q of n){l=id(q);try{h=!0,e(f,l)}finally{md(l)}}else c==null||c(a,p,n)}),h)){let l=a[z]|0;
if(l&2&&l&16384)throw Error();Kb(f,f[z]|0,(p,n)=>{if(Kc(a,l,p)!=null)switch(b==null?void 0:b.Mb){case 1:return;default:throw Error();}l=F(a,l,p,n);delete g[p]})}}}
function Ed(a){a=Array.isArray(a)?a[0]instanceof sd?a:[ud,a]:[a,void 0];const b=a[0].W;if(a=a[1]){const c=Dd(a),d=Ad(a).ca;return(e,f,g)=>b(e,f,g,d,c)}return b}
;var Gd;
Gd=new sd(function(a,b,c){if(a.i!==2)return!1;var d=dd(a.h)>>>0;a=a.h;var e=fd(a,d);a=a.j;if(Ma){var f=a,g;(g=La)||(g=La=new TextDecoder("utf-8",{fatal:!0}));d=e+d;f=e===0&&d===f.length?f:f.subarray(e,d);try{var h=g.decode(f)}catch(l){if(Ka===void 0){try{g.decode(new Uint8Array([128]))}catch(p){}try{g.decode(new Uint8Array([97])),Ka=!0}catch(p){Ka=!1}}!Ka&&(La=void 0);throw l;}}else{h=e;d=h+d;e=[];let l=null;let p;for(;h<d;){var k=a[h++];k<128?e.push(k):k<224?h>=d?Ia():(p=a[h++],k<194||(p&192)!==
128?(h--,Ia()):e.push((k&31)<<6|p&63)):k<240?h>=d-1?Ia():(p=a[h++],(p&192)!==128||k===224&&p<160||k===237&&p>=160||((g=a[h++])&192)!==128?(h--,Ia()):e.push((k&15)<<12|(p&63)<<6|g&63)):k<=244?h>=d-2?Ia():(p=a[h++],(p&192)!==128||(k<<28)+(p-144)>>30!==0||((g=a[h++])&192)!==128||((f=a[h++])&192)!==128?(h--,Ia()):(k=(k&7)<<18|(p&63)<<12|(g&63)<<6|f&63,k-=65536,e.push((k>>10&1023)+55296,(k&1023)+56320))):Ia();e.length>=8192&&(l=Ja(l,e),e.length=0)}h=Ja(l,e)}F(b,b[z]|0,c,h);return!0},qd());
var Hd=function(a,b,c=rd){return new sd(a,c)}(function(a,b,c,d,e){if(a.i!==2)return!1;
d=Ec(void 0,d,!0);var f=b[z]|0;Ib(f);let g=Lc(b,f,c);const h=g!==Gb;if(64&f||!(8192&f)||!h){const k=h?g[z]|0:0;let l=k;if(!h||2&l||Oc(l)||4&l&&!(32&l))g=Array.prototype.slice.call(g),l=Nc(l,f),f=F(b,f,c,g);l=Mc(l,f)&-13;l=Vc(l&-17,f,!0);l!==k&&A(g,l)}g.push(d);pd(a,d,e);return!0},function(a,b,c,d,e){if(Array.isArray(b))for(let l=0;l<b.length;l++){var f=e,g=a,h=g.h;
var k=b[l];k=k instanceof K?k.o:Array.isArray(k)?Ec(k,d,!1):void 0;h.call(g,c,k,f)}});function Id(){}
;function Jd(a){for(const b in a)return!1;return!0}
function Kd(a){if(!a||typeof a!=="object")return a;if(typeof a.clone==="function")return a.clone();if(typeof Map!=="undefined"&&a instanceof Map)return new Map(a);if(typeof Set!=="undefined"&&a instanceof Set)return new Set(a);if(a instanceof Date)return new Date(a.getTime());const b=Array.isArray(a)?[]:typeof ArrayBuffer!=="function"||typeof ArrayBuffer.isView!=="function"||!ArrayBuffer.isView(a)||a instanceof DataView?{}:new a.constructor(a.length);for(const c in a)b[c]=Kd(a[c]);return b}
const Ld="constructor hasOwnProperty isPrototypeOf propertyIsEnumerable toLocaleString toString valueOf".split(" ");function Md(a,b){let c,d;for(let e=1;e<arguments.length;e++){d=arguments[e];for(c in d)a[c]=d[c];for(let f=0;f<Ld.length;f++)c=Ld[f],Object.prototype.hasOwnProperty.call(d,c)&&(a[c]=d[c])}}
;function Nd(a,b){this.h=a===Od&&b||""}
Nd.prototype.toString=function(){return this.h};
var Od={};new Nd(Od,"");function Pd(a){if(!a)return"";if(/^about:(?:blank|srcdoc)$/.test(a))return window.origin||"";a.indexOf("blob:")===0&&(a=a.substring(5));a=a.split("#")[0].split("?")[0];a=a.toLowerCase();a.indexOf("//")==0&&(a=window.location.protocol+a);/^[\w\-]*:\/\//.test(a)||(a=window.location.href);var b=a.substring(a.indexOf("://")+3),c=b.indexOf("/");c!=-1&&(b=b.substring(0,c));c=a.substring(0,a.indexOf("://"));if(!c)throw Error("URI is missing protocol: "+a);if(c!=="http"&&c!=="https"&&c!=="chrome-extension"&&
c!=="moz-extension"&&c!=="file"&&c!=="android-app"&&c!=="chrome-search"&&c!=="chrome-untrusted"&&c!=="chrome"&&c!=="app"&&c!=="devtools")throw Error("Invalid URI scheme in origin: "+c);a="";var d=b.indexOf(":");if(d!=-1){var e=b.substring(d+1);b=b.substring(0,d);if(c==="http"&&e!=="80"||c==="https"&&e!=="443")a=":"+e}return c+"://"+b+a}
;function Qd(){function a(){e[0]=1732584193;e[1]=4023233417;e[2]=2562383102;e[3]=271733878;e[4]=3285377520;p=l=0}
function b(n){for(var q=g,m=0;m<64;m+=4)q[m/4]=n[m]<<24|n[m+1]<<16|n[m+2]<<8|n[m+3];for(m=16;m<80;m++)n=q[m-3]^q[m-8]^q[m-14]^q[m-16],q[m]=(n<<1|n>>>31)&4294967295;n=e[0];var u=e[1],B=e[2],y=e[3],G=e[4];for(m=0;m<80;m++){if(m<40)if(m<20){var ia=y^u&(B^y);var Xb=1518500249}else ia=u^B^y,Xb=1859775393;else m<60?(ia=u&B|y&(u|B),Xb=2400959708):(ia=u^B^y,Xb=3395469782);ia=((n<<5|n>>>27)&4294967295)+ia+G+Xb+q[m]&4294967295;G=y;y=B;B=(u<<30|u>>>2)&4294967295;u=n;n=ia}e[0]=e[0]+n&4294967295;e[1]=e[1]+u&4294967295;
e[2]=e[2]+B&4294967295;e[3]=e[3]+y&4294967295;e[4]=e[4]+G&4294967295}
function c(n,q){if(typeof n==="string"){n=unescape(encodeURIComponent(n));for(var m=[],u=0,B=n.length;u<B;++u)m.push(n.charCodeAt(u));n=m}q||(q=n.length);m=0;if(l==0)for(;m+64<q;)b(n.slice(m,m+64)),m+=64,p+=64;for(;m<q;)if(f[l++]=n[m++],p++,l==64)for(l=0,b(f);m+64<q;)b(n.slice(m,m+64)),m+=64,p+=64}
function d(){var n=[],q=p*8;l<56?c(h,56-l):c(h,64-(l-56));for(var m=63;m>=56;m--)f[m]=q&255,q>>>=8;b(f);for(m=q=0;m<5;m++)for(var u=24;u>=0;u-=8)n[q++]=e[m]>>u&255;return n}
for(var e=[],f=[],g=[],h=[128],k=1;k<64;++k)h[k]=0;var l,p;a();return{reset:a,update:c,digest:d,za:function(){for(var n=d(),q="",m=0;m<n.length;m++)q+="0123456789ABCDEF".charAt(Math.floor(n[m]/16))+"0123456789ABCDEF".charAt(n[m]%16);return q}}}
;function Rd(a,b,c){var d=String(t.location.href);return d&&a&&b?[b,Sd(Pd(d),a,c||null)].join(" "):null}
function Sd(a,b,c){var d=[];let e=[];if((Array.isArray(c)?2:1)==1)return e=[b,a],va(d,function(h){e.push(h)}),Td(e.join(" "));
const f=[],g=[];va(c,function(h){g.push(h.key);f.push(h.value)});
c=Math.floor((new Date).getTime()/1E3);e=f.length==0?[c,b,a]:[f.join(":"),c,b,a];va(d,function(h){e.push(h)});
a=Td(e.join(" "));a=[c,a];g.length==0||a.push(g.join(""));return a.join("_")}
function Td(a){const b=Qd();b.update(a);return b.za().toLowerCase()}
;function Ud(){this.h=document||{cookie:""}}
Ud.prototype.isEnabled=function(){if(!t.navigator.cookieEnabled)return!1;if(this.h.cookie)return!0;this.set("TESTCOOKIESENABLED","1",{la:60});if(this.get("TESTCOOKIESENABLED")!=="1")return!1;this.remove("TESTCOOKIESENABLED");return!0};
Ud.prototype.set=function(a,b,c){let d,e,f,g=!1,h;typeof c==="object"&&(h=c.Pb,g=c.Qb||!1,f=c.domain||void 0,e=c.path||void 0,d=c.la);if(/[;=\s]/.test(a))throw Error('Invalid cookie name "'+a+'"');if(/[;\r\n]/.test(b))throw Error('Invalid cookie value "'+b+'"');d===void 0&&(d=-1);this.h.cookie=a+"="+b+(f?";domain="+f:"")+(e?";path="+e:"")+(d<0?"":d==0?";expires="+(new Date(1970,1,1)).toUTCString():";expires="+(new Date(Date.now()+d*1E3)).toUTCString())+(g?";secure":"")+(h!=null?";samesite="+h:"")};
Ud.prototype.get=function(a,b){const c=a+"=",d=(this.h.cookie||"").split(";");for(let e=0,f;e<d.length;e++){f=pa(d[e]);if(f.lastIndexOf(c,0)==0)return f.slice(c.length);if(f==a)return""}return b};
Ud.prototype.remove=function(a,b,c){const d=this.get(a)!==void 0;this.set(a,"",{la:0,path:b,domain:c});return d};
Ud.prototype.clear=function(){var a=(this.h.cookie||"").split(";");const b=[],c=[];let d,e;for(let f=0;f<a.length;f++)e=pa(a[f]),d=e.indexOf("="),d==-1?(b.push(""),c.push(e)):(b.push(e.substring(0,d)),c.push(e.substring(d+1)));for(a=b.length-1;a>=0;a--)this.remove(b[a])};function Vd(a,b,c,d){(a=t[a])||typeof document==="undefined"||(a=(new Ud).get(b));return a?Rd(a,c,d):null}
;var Wd=typeof AsyncContext!=="undefined"&&typeof AsyncContext.Snapshot==="function"?a=>a&&AsyncContext.Snapshot.wrap(a):a=>a;function Xd(){this.l=this.l;this.i=this.i}
Xd.prototype.l=!1;Xd.prototype.dispose=function(){this.l||(this.l=!0,this.m())};
Xd.prototype[Symbol.dispose]=function(){this.dispose()};
Xd.prototype.addOnDisposeCallback=function(a,b){this.l?b!==void 0?a.call(b):a():(this.i||(this.i=[]),b&&(a=a.bind(b)),this.i.push(a))};
Xd.prototype.m=function(){if(this.i)for(;this.i.length;)this.i.shift()()};function Yd(a,b){a.l(b);a.i<100&&(a.i++,b.next=a.h,a.h=b)}
class Zd{constructor(a,b){this.j=a;this.l=b;this.i=0;this.h=null}get(){let a;this.i>0?(this.i--,a=this.h,this.h=a.next,a.next=null):a=this.j();return a}};class $d{constructor(){this.i=this.h=null}add(a,b){const c=ae.get();c.set(a,b);this.i?this.i.next=c:this.h=c;this.i=c}remove(){let a=null;this.h&&(a=this.h,this.h=this.h.next,this.h||(this.i=null),a.next=null);return a}}var ae=new Zd(()=>new be,a=>a.reset());
class be{constructor(){this.next=this.scope=this.h=null}set(a,b){this.h=a;this.scope=b;this.next=null}reset(){this.next=this.scope=this.h=null}};let ce,de=!1,ee=new $d,ge=(a,b)=>{ce||fe();de||(ce(),de=!0);ee.add(a,b)},fe=()=>{const a=Promise.resolve(void 0);
ce=()=>{a.then(he)}};
function he(){let a;for(;a=ee.remove();){try{a.h.call(a.scope)}catch(b){Na(b)}Yd(ae,a)}de=!1}
;function L(a){this.h=0;this.v=void 0;this.l=this.i=this.j=null;this.m=this.s=!1;if(a!=Id)try{const b=this;a.call(void 0,function(c){ie(b,2,c)},function(c){ie(b,3,c)})}catch(b){ie(this,3,b)}}
function je(){this.next=this.context=this.i=this.j=this.h=null;this.l=!1}
je.prototype.reset=function(){this.context=this.i=this.j=this.h=null;this.l=!1};
var ke=new Zd(function(){return new je},function(a){a.reset()});
function le(a,b,c){const d=ke.get();d.j=a;d.i=b;d.context=c;return d}
function me(a){if(a instanceof L)return a;const b=new L(Id);ie(b,2,a);return b}
L.prototype.then=function(a,b,c){return ne(this,Wd(typeof a==="function"?a:null),Wd(typeof b==="function"?b:null),c)};
L.prototype.$goog_Thenable=!0;L.prototype.C=function(a,b){return ne(this,null,Wd(a),b)};
L.prototype.catch=L.prototype.C;L.prototype.cancel=function(a){if(this.h==0){const b=new oe(a);ge(function(){pe(this,b)},this)}};
function pe(a,b){if(a.h==0)if(a.j){var c=a.j;if(c.i){var d=0,e=null,f=null;for(let g=c.i;g&&(g.l||(d++,g.h==a&&(e=g),!(e&&d>1)));g=g.next)e||(f=g);e&&(c.h==0&&d==1?pe(c,b):(f?(d=f,d.next==c.l&&(c.l=d),d.next=d.next.next):qe(c),re(c,e,3,b)))}a.j=null}else ie(a,3,b)}
function se(a,b){a.i||a.h!=2&&a.h!=3||te(a);a.l?a.l.next=b:a.i=b;a.l=b}
function ne(a,b,c,d){const e=le(null,null,null);e.h=new L(function(f,g){e.j=b?function(h){try{const k=b.call(d,h);f(k)}catch(k){g(k)}}:f;
e.i=c?function(h){try{const k=c.call(d,h);k===void 0&&h instanceof oe?g(h):f(k)}catch(k){g(k)}}:g});
e.h.j=a;se(a,e);return e.h}
L.prototype.H=function(a){this.h=0;ie(this,2,a)};
L.prototype.K=function(a){this.h=0;ie(this,3,a)};
function ie(a,b,c){if(a.h==0){a===c&&(b=3,c=new TypeError("Promise cannot resolve to itself"));a.h=1;a:{var d=c,e=a.H,f=a.K;if(d instanceof L){se(d,le(e||Id,f||null,a));var g=!0}else{if(d)try{var h=!!d.$goog_Thenable}catch(k){h=!1}else h=!1;if(h)d.then(e,f,a),g=!0;else{h=typeof d;if(h=="object"&&d!=null||h=="function")try{const k=d.then;if(typeof k==="function"){ue(d,k,e,f,a);g=!0;break a}}catch(k){f.call(a,k);g=!0;break a}g=!1}}}g||(a.v=c,a.h=b,a.j=null,te(a),b!=3||c instanceof oe||ve(a,c))}}
function ue(a,b,c,d,e){function f(k){h||(h=!0,d.call(e,k))}
function g(k){h||(h=!0,c.call(e,k))}
let h=!1;try{b.call(a,g,f)}catch(k){f(k)}}
function te(a){a.s||(a.s=!0,ge(a.B,a))}
function qe(a){let b=null;a.i&&(b=a.i,a.i=b.next,b.next=null);a.i||(a.l=null);return b}
L.prototype.B=function(){let a;for(;a=qe(this);)re(this,a,this.h,this.v);this.s=!1};
function re(a,b,c,d){if(c==3&&b.i&&!b.l)for(;a&&a.m;a=a.j)a.m=!1;if(b.h)b.h.j=null,we(b,c,d);else try{b.l?b.j.call(b.context):we(b,c,d)}catch(e){xe.call(null,e)}Yd(ke,b)}
function we(a,b,c){b==2?a.j.call(a.context,c):a.i&&a.i.call(a.context,c)}
function ve(a,b){a.m=!0;ge(function(){a.m&&xe.call(null,b)})}
var xe=Na;function oe(a){oa.call(this,a)}
na(oe,oa);oe.prototype.name="cancel";const ye=self;class ze{constructor(){this.promise=new Promise((a,b)=>{this.resolve=a;this.reject=b})}}
;function M(a){Xd.call(this);this.H=1;this.s=[];this.v=0;this.h=[];this.j={};this.X=!!a}
na(M,Xd);M.prototype.K=function(a,b,c){let d=this.j[a];d||(d=this.j[a]=[]);const e=this.H;this.h[e]=a;this.h[e+1]=b;this.h[e+2]=c;this.H=e+3;d.push(e);return e};
M.prototype.C=function(a){const b=this.h[a];if(b){const c=this.j[b];this.v!=0?(this.s.push(a),this.h[a+1]=()=>{}):(c&&xa(c,a),delete this.h[a],delete this.h[a+1],delete this.h[a+2])}return!!b};
M.prototype.B=function(a,b){var c=this.j[a];if(c){const e=Array(arguments.length-1);var d=arguments.length;let f;for(f=1;f<d;f++)e[f-1]=arguments[f];if(this.X)for(f=0;f<c.length;f++)d=c[f],Ae(this.h[d+1],this.h[d+2],e);else{this.v++;try{for(f=0,d=c.length;f<d&&!this.l;f++){const g=c[f];this.h[g+1].apply(this.h[g+2],e)}}finally{if(this.v--,this.s.length>0&&this.v==0)for(;c=this.s.pop();)this.C(c)}}return f!=0}return!1};
function Ae(a,b,c){ge(function(){a.apply(b,c)})}
M.prototype.clear=function(a){if(a){const b=this.j[a];b&&(b.forEach(this.C,this),delete this.j[a])}else this.h.length=0,this.j={}};
M.prototype.m=function(){M.La.m.call(this);this.clear();this.s.length=0};/*

 (The MIT License)

 Copyright (C) 2014 by Vitaly Puzrin

 Permission is hereby granted, free of charge, to any person obtaining a copy
 of this software and associated documentation files (the "Software"), to deal
 in the Software without restriction, including without limitation the rights
 to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 copies of the Software, and to permit persons to whom the Software is
 furnished to do so, subject to the following conditions:

 The above copyright notice and this permission notice shall be included in
 all copies or substantial portions of the Software.

 THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 THE SOFTWARE.

 -----------------------------------------------------------------------------
 Ported from zlib, which is under the following license
 https://github.com/madler/zlib/blob/master/zlib.h

 zlib.h -- interface of the 'zlib' general purpose compression library
   version 1.2.8, April 28th, 2013
   Copyright (C) 1995-2013 Jean-loup Gailly and Mark Adler
   This software is provided 'as-is', without any express or implied
   warranty.  In no event will the authors be held liable for any damages
   arising from the use of this software.
   Permission is granted to anyone to use this software for any purpose,
   including commercial applications, and to alter it and redistribute it
   freely, subject to the following restrictions:
   1. The origin of this software must not be misrepresented; you must not
      claim that you wrote the original software. If you use this software
      in a product, an acknowledgment in the product documentation would be
      appreciated but is not required.
   2. Altered source versions must be plainly marked as such, and must not be
      misrepresented as being the original software.
   3. This notice may not be removed or altered from any source distribution.
   Jean-loup Gailly        Mark Adler
   jloup@gzip.org          madler@alumni.caltech.edu
   The data format used by the zlib library is described by RFCs (Request for
   Comments) 1950 to 1952 in the files http://tools.ietf.org/html/rfc1950
   (zlib format), rfc1951 (deflate format) and rfc1952 (gzip format).
*/
let N={};var Be=typeof Uint8Array!=="undefined"&&typeof Uint16Array!=="undefined"&&typeof Int32Array!=="undefined";N.assign=function(a){for(var b=Array.prototype.slice.call(arguments,1);b.length;){var c=b.shift();if(c){if(typeof c!=="object")throw new TypeError(c+"must be non-object");for(var d in c)Object.prototype.hasOwnProperty.call(c,d)&&(a[d]=c[d])}}return a};
N.Tb=function(a,b){if(a.length===b)return a;if(a.subarray)return a.subarray(0,b);a.length=b;return a};
var Ce={va:function(a,b,c,d,e){if(b.subarray&&a.subarray)a.set(b.subarray(c,c+d),e);else for(var f=0;f<d;f++)a[e+f]=b[c+f]},
Aa:function(a){var b,c;var d=c=0;for(b=a.length;d<b;d++)c+=a[d].length;var e=new Uint8Array(c);d=c=0;for(b=a.length;d<b;d++){var f=a[d];e.set(f,c);c+=f.length}return e}},De={va:function(a,b,c,d,e){for(var f=0;f<d;f++)a[e+f]=b[c+f]},
Aa:function(a){return[].concat.apply([],a)}};
N.Ka=function(){Be?(N.qa=Uint8Array,N.oa=Uint16Array,N.pa=Int32Array,N.assign(N,Ce)):(N.qa=Array,N.oa=Array,N.pa=Array,N.assign(N,De))};
N.Ka();try{new Uint8Array(1)}catch(a){};function Ee(a){for(var b=a.length;--b>=0;)a[b]=0}
Ee(Array(576));Ee(Array(60));Ee(Array(512));Ee(Array(256));Ee(Array(29));Ee(Array(30));/*

Math.uuid.js (v1.4)
http://www.broofa.com
mailto:robert@broofa.com
Copyright (c) 2010 Robert Kieffer
Dual licensed under the MIT and GPL licenses.
*/
var Fe="0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz".split("");var Ge=class{constructor(a){this.name=a}};var He=new Ge("rawColdConfigGroup");var Ie=new Ge("rawHotConfigGroup");var Je=class extends K{constructor(a){super(a)}};var Ke=class extends K{constructor(a){super(a)}};var Le=class extends K{constructor(a){super(a)}};var Me=class extends K{constructor(a){super(a)}getPlayerType(){var a=Jc(this,36);a=a==null?a:gc(a)?a|0:void 0;return a!=null?a:0}setHomeGroupInfo(a){return H(this,Le,81,a)}clearLocationPlayabilityToken(){return E(this,89)}};var Ne=class extends K{constructor(a){super(a)}getKey(){return Xc(this,1)}},Oe=[2,3,4,5,6];var Pe=class extends K{constructor(a){super(a)}setTrackingParams(a){if(a!=null)if(typeof a==="string")a=a?new nb(a,kb):lb();else if(a.constructor!==nb)if(jb(a))a=a.length?new nb(new Uint8Array(a),kb):lb();else throw Error();return E(this,1,a)}};var Qe=class extends K{constructor(a){super(a)}};var Re=class extends K{constructor(a){super(a)}};var Se=class extends K{constructor(a){super(a)}};var Te=class extends K{constructor(a){super(a)}setSafetyMode(a){return E(this,5,lc(a))}};var Ue=class extends K{constructor(a){super(a)}j(a){return H(this,Me,1,a)}};var Ve=class extends K{constructor(a){super(a,500)}};var We=class extends K{constructor(a){super(a)}};var Xe=class extends K{constructor(a){super(a)}setVideoId(a){return Pc(this,1,Zc,pc(a))}getPlaylistId(){return Yc(this,2)}},Zc=[1,2];var Ye=class extends K{constructor(a){super(a)}};var Ze=new Ge("recordNotificationInteractionsEndpoint");var $e=["notification/convert_endpoint_to_url"],af=["notification/record_interactions"],bf=["notification_registration/set_registration"];var cf=a=>self.btoa(String.fromCharCode.apply(null,Array.from(new Uint8Array(a)))).replace(/\+/g,"-").replace(/\//g,"_");var df=["notifications_register","notifications_check_registration"];var O=class extends Error{constructor(a,...b){super(a);this.args=[...b];Object.setPrototypeOf(this,new.target.prototype)}};let ef=null;function P(a,b){const c={};c.key=a;c.value=b;return ff().then(d=>new Promise((e,f)=>{try{const g=d.transaction("swpushnotificationsstore","readwrite").objectStore("swpushnotificationsstore").put(c);g.onsuccess=()=>{e()};
g.onerror=()=>{f()}}catch(g){f(g)}}))}
function gf(){return P("IndexedDBCheck","testing IndexedDB").then(()=>hf("IndexedDBCheck")).then(a=>a==="testing IndexedDB"?Promise.resolve():Promise.reject()).then(()=>!0).catch(()=>!1)}
function hf(a){const b=new O("Error accessing DB");return ff().then(c=>new Promise((d,e)=>{try{const f=c.transaction("swpushnotificationsstore").objectStore("swpushnotificationsstore").get(a);f.onsuccess=()=>{const g=f.result;d(g?g.value:null)};
f.onerror=()=>{b.params={key:a,source:"onerror"};e(b)}}catch(f){b.params={key:a,
thrownError:String(f)},e(b)}}),()=>null)}
function ff(){return ef?Promise.resolve(ef):new Promise((a,b)=>{const c=self.indexedDB.open("swpushnotificationsdb");c.onerror=b;c.onsuccess=()=>{const d=c.result;if(d.objectStoreNames.contains("swpushnotificationsstore"))ef=d,a(ef);else return self.indexedDB.deleteDatabase("swpushnotificationsdb"),ff()};
c.onupgradeneeded=jf})}
function jf(a){a=a.target.result;a.objectStoreNames.contains("swpushnotificationsstore")&&a.deleteObjectStore("swpushnotificationsstore");a.createObjectStore("swpushnotificationsstore",{keyPath:"key"})}
;const kf={WEB_UNPLUGGED:"^unplugged/",WEB_UNPLUGGED_ONBOARDING:"^unplugged/",WEB_UNPLUGGED_OPS:"^unplugged/",WEB_UNPLUGGED_PUBLIC:"^unplugged/",WEB_CREATOR:"^creator/",WEB_KIDS:"^kids/",WEB_EXPERIMENTS:"^experiments/",WEB_MUSIC:"^music/",WEB_REMIX:"^music/",WEB_MUSIC_EMBEDDED_PLAYER:"^music/",WEB_MUSIC_EMBEDDED_PLAYER:"^main_app/|^sfv/"};
function lf(a){if(a.length===1)return a[0];var b=kf.UNKNOWN_INTERFACE;if(b){b=new RegExp(b);for(var c of a)if(b.exec(c))return c}const d=[];Object.entries(kf).forEach(([e,f])=>{"UNKNOWN_INTERFACE"!==e&&d.push(f)});
c=new RegExp(d.join("|"));a.sort((e,f)=>e.length-f.length);
for(const e of a)if(!c.exec(e))return e;return a[0]}
function mf(a){return`/youtubei/v1/${lf(a)}`}
;var nf=class extends K{constructor(a){super(a)}};var of=class extends K{constructor(a){super(a,0,"yt.sw.adr")}};const pf=t.window;let qf,rf;const sf=(pf==null?void 0:(qf=pf.yt)==null?void 0:qf.config_)||(pf==null?void 0:(rf=pf.ytcfg)==null?void 0:rf.data_)||{};w("yt.config_",sf);function Q(...a){a=arguments;a.length>1?sf[a[0]]=a[1]:a.length===1&&Object.assign(sf,a[0])}
function R(a,b){return a in sf?sf[a]:b}
;const tf=[];function uf(a){tf.forEach(b=>b(a))}
function vf(a){return a&&window.yterr?function(){try{return a.apply(this,arguments)}catch(b){wf(b)}}:a}
function wf(a){var b=v("yt.logging.errors.log");b?b(a,"ERROR",void 0,void 0,void 0,void 0,void 0):(b=R("ERRORS",[]),b.push([a,"ERROR",void 0,void 0,void 0,void 0,void 0]),Q("ERRORS",b));uf(a)}
function xf(a){var b=v("yt.logging.errors.log");b?b(a,"WARNING",void 0,void 0,void 0,void 0,void 0):(b=R("ERRORS",[]),b.push([a,"WARNING",void 0,void 0,void 0,void 0,void 0]),Q("ERRORS",b))}
;const yf=/^[\w.]*$/,zf={q:!0,search_query:!0};function Af(a,b){b=a.split(b);const c={};for(let f=0,g=b.length;f<g;f++){const h=b[f].split("=");if(h.length===1&&h[0]||h.length===2)try{const k=Bf(h[0]||""),l=Bf(h[1]||"");if(k in c){const p=c[k];Array.isArray(p)?ya(p,l):c[k]=[p,l]}else c[k]=l}catch(k){var d=k,e=h[0];const l=String(Af);d.args=[{key:e,value:h[1],query:a,method:Cf===l?"unchanged":l}];zf.hasOwnProperty(e)||xf(d)}}return c}
const Cf=String(Af);function Df(a){a.charAt(0)==="?"&&(a=a.substring(1));return Af(a,"&")}
function Ef(a,b){return Ff(a,b||{},!0)}
function Ff(a,b,c){var d=a.split("#",2);a=d[0];d=d.length>1?"#"+d[1]:"";var e=a.split("?",2);a=e[0];e=Df(e[1]||"");for(var f in b)!c&&e!==null&&f in e||(e[f]=b[f]);b=a;a=Ha(e);a?(c=b.indexOf("#"),c<0&&(c=b.length),f=b.indexOf("?"),f<0||f>c?(f=c,e=""):e=b.substring(f+1,c),b=[b.slice(0,f),e,b.slice(c)],c=b[1],b[1]=a?c?c+"&"+a:a:c,a=b[0]+(b[1]?"?"+b[1]:"")+b[2]):a=b;return a+d}
function Gf(a){if(!b)var b=window.location.href;const c=a.match(Ea)[1]||null,d=Fa(a.match(Ea)[3]||null);c&&d?(a=a.match(Ea),b=b.match(Ea),a=a[3]==b[3]&&a[1]==b[1]&&a[4]==b[4]):a=d?Fa(b.match(Ea)[3]||null)===d&&(Number(b.match(Ea)[4]||null)||null)===(Number(a.match(Ea)[4]||null)||null):!0;return a}
function Bf(a){return a&&a.match(yf)?a:decodeURIComponent(a.replace(/\+/g," "))}
;function Hf(a,b){typeof a==="function"&&(a=vf(a));return window.setTimeout(a,b)}
;var If="client_dev_domain client_dev_expflag client_dev_regex_map client_dev_root_url client_rollout_override expflag forcedCapability jsfeat jsmode mods".split(" "),Jf=[...If,"client_dev_set_cookie"];function S(a){a=Kf(a);return typeof a==="string"&&a==="false"?!1:!!a}
function T(a,b){a=Kf(a);return a===void 0&&b!==void 0?b:Number(a||0)}
function Lf(){return R("EXPERIMENTS_TOKEN","")}
function Kf(a){return R("EXPERIMENT_FLAGS",{})[a]}
function Mf(){const a=[],b=R("EXPERIMENTS_FORCED_FLAGS",{});for(var c of Object.keys(b))a.push({key:c,value:String(b[c])});c=R("EXPERIMENT_FLAGS",{});for(const d of Object.keys(c))d.startsWith("force_")&&b[d]===void 0&&a.push({key:d,value:String(c[d])});return a}
;[...If];let Nf=!1;function Of(a,b){const c={method:b.method||"GET",credentials:"same-origin"};b.headers&&(c.headers=b.headers);b.priority&&(c.priority=b.priority);a=Pf(a,b);const d=Qf(a,b);d&&(c.body=d);b.withCredentials&&(c.credentials="include");const e=b.context||t;let f=!1,g;fetch(a,c).then(h=>{if(!f){f=!0;g&&window.clearTimeout(g);var k=h.ok,l=p=>{p=p||{};k?b.onSuccess&&b.onSuccess.call(e,p,h):b.onError&&b.onError.call(e,p,h);b.onFinish&&b.onFinish.call(e,p,h)};
(b.format||"JSON")==="JSON"&&(k||h.status>=400&&h.status<500)?h.json().then(l,()=>{l(null)}):l(null)}}).catch(()=>{b.onError&&b.onError.call(e,{},{})});
a=b.timeout||0;b.onFetchTimeout&&a>0&&(g=Hf(()=>{f||(f=!0,window.clearTimeout(g),b.onFetchTimeout.call(b.context||t))},a))}
function Pf(a,b){b.includeDomain&&(a=document.location.protocol+"//"+document.location.hostname+(document.location.port?":"+document.location.port:"")+a);const c=R("XSRF_FIELD_NAME");if(b=b.urlParams)b[c]&&delete b[c],a=Ef(a,b);return a}
function Qf(a,b){const c=R("XSRF_FIELD_NAME"),d=R("XSRF_TOKEN");var e=b.postBody||"",f=b.postParams;const g=R("XSRF_FIELD_NAME");let h;b.headers&&(h=b.headers["Content-Type"]);b.excludeXsrf||Fa(a.match(Ea)[3]||null)&&!b.withCredentials&&Fa(a.match(Ea)[3]||null)!==document.location.hostname||b.method!=="POST"||h&&h!=="application/x-www-form-urlencoded"||b.postParams&&b.postParams[g]||(f||(f={}),f[c]=d);(S("ajax_parse_query_data_only_when_filled")&&f&&Object.keys(f).length>0||f)&&typeof e==="string"&&
(e=Df(e),Md(e,f),e=b.postBodyFormat&&b.postBodyFormat==="JSON"?JSON.stringify(e):Ha(e));f=e||f&&!Jd(f);!Nf&&f&&b.method!=="POST"&&(Nf=!0,wf(Error("AJAX request with postData should use POST")));return e}
;const Rf=[{ba:a=>`Cannot read property '${a.key}'`,
U:{Error:[{u:/(Permission denied) to access property "([^']+)"/,groups:["reason","key"]}],TypeError:[{u:/Cannot read property '([^']+)' of (null|undefined)/,groups:["key","value"]},{u:/\u65e0\u6cd5\u83b7\u53d6\u672a\u5b9a\u4e49\u6216 (null|undefined) \u5f15\u7528\u7684\u5c5e\u6027\u201c([^\u201d]+)\u201d/,groups:["value","key"]},{u:/\uc815\uc758\ub418\uc9c0 \uc54a\uc74c \ub610\ub294 (null|undefined) \ucc38\uc870\uc778 '([^']+)' \uc18d\uc131\uc744 \uac00\uc838\uc62c \uc218 \uc5c6\uc2b5\ub2c8\ub2e4./,
groups:["value","key"]},{u:/No se puede obtener la propiedad '([^']+)' de referencia nula o sin definir/,groups:["key"]},{u:/Unable to get property '([^']+)' of (undefined or null) reference/,groups:["key","value"]},{u:/(null) is not an object \(evaluating '(?:([^.]+)\.)?([^']+)'\)/,groups:["value","base","key"]}]}},{ba:a=>`Cannot call '${a.key}'`,
U:{TypeError:[{u:/(?:([^ ]+)?\.)?([^ ]+) is not a function/,groups:["base","key"]},{u:/([^ ]+) called on (null or undefined)/,groups:["key","value"]},{u:/Object (.*) has no method '([^ ]+)'/,groups:["base","key"]},{u:/Object doesn't support property or method '([^ ]+)'/,groups:["key"]},{u:/\u30aa\u30d6\u30b8\u30a7\u30af\u30c8\u306f '([^']+)' \u30d7\u30ed\u30d1\u30c6\u30a3\u307e\u305f\u306f\u30e1\u30bd\u30c3\u30c9\u3092\u30b5\u30dd\u30fc\u30c8\u3057\u3066\u3044\u307e\u305b\u3093/,groups:["key"]},{u:/\uac1c\uccb4\uac00 '([^']+)' \uc18d\uc131\uc774\ub098 \uba54\uc11c\ub4dc\ub97c \uc9c0\uc6d0\ud558\uc9c0 \uc54a\uc2b5\ub2c8\ub2e4./,
groups:["key"]}]}},{ba:a=>`${a.key} is not defined`,
U:{ReferenceError:[{u:/(.*) is not defined/,groups:["key"]},{u:/Can't find variable: (.*)/,groups:["key"]}]}}];var Tf={F:[],D:[{callback:Sf,weight:500}]};function Sf(a){if(a.name==="JavaException")return!0;a=a.stack;return a.includes("chrome://")||a.includes("chrome-extension://")||a.includes("moz-extension://")}
;function Uf(){if(!Vf){var a=Vf=new Wf;a.F.length=0;a.D.length=0;Xf(a,Tf)}return Vf}
function Xf(a,b){b.F&&a.F.push.apply(a.F,b.F);b.D&&a.D.push.apply(a.D,b.D)}
var Wf=class{constructor(){this.D=[];this.F=[]}},Vf;const Yf=new M;function Zf(a){const b=a.length;let c=0;const d=()=>a.charCodeAt(c++);
do{var e=$f(d);if(e===Infinity)break;const f=e>>3;switch(e&7){case 0:e=$f(d);if(f===2)return e;break;case 1:if(f===2)return;c+=8;break;case 2:e=$f(d);if(f===2)return a.substr(c,e);c+=e;break;case 5:if(f===2)return;c+=4;break;default:return}}while(c<b)}
function $f(a){let b=a(),c=b&127;if(b<128)return c;b=a();c|=(b&127)<<7;if(b<128)return c;b=a();c|=(b&127)<<14;if(b<128)return c;b=a();return b<128?c|(b&127)<<21:Infinity}
;function ag(a,b,c,d){if(a)if(Array.isArray(a)){var e=d;for(d=0;d<a.length&&!(a[d]&&(e+=bg(d,a[d],b,c),e>500));d++);d=e}else if(typeof a==="object")for(e in a){if(a[e]){var f=e;var g=a[e],h=b,k=c;f=typeof g!=="string"||f!=="clickTrackingParams"&&f!=="trackingParams"?0:(g=Zf(atob(g.replace(/-/g,"+").replace(/_/g,"/"))))?bg(`${f}.ve`,g,h,k):0;d+=f;d+=bg(e,a[e],b,c);if(d>500)break}}else c[b]=cg(a),d+=c[b].length;else c[b]=cg(a),d+=c[b].length;return d}
function bg(a,b,c,d){c+=`.${a}`;a=cg(b);d[c]=a;return c.length+a.length}
function cg(a){try{return(typeof a==="string"?a:String(JSON.stringify(a))).substr(0,500)}catch(b){return`unable to serialize ${typeof a} (${b.message})`}}
;function dg(){eg.instance||(eg.instance=new eg);return eg.instance}
function fg(a,b){a={};var c=[];"USER_SESSION_ID"in sf&&c.push({key:"u",value:R("USER_SESSION_ID")});var d=Pd(String(t.location.href));var e=[];var f;(f=t.__SAPISID||t.__APISID||t.__3PSAPISID||t.__1PSAPISID||t.__OVERRIDE_SID)?f=!0:(typeof document!=="undefined"&&(f=new Ud,f=f.get("SAPISID")||f.get("APISID")||f.get("__Secure-3PAPISID")||f.get("__Secure-1PAPISID")),f=!!f);f&&(f=(d=d.indexOf("https:")==0||d.indexOf("chrome-extension:")==0||d.indexOf("chrome-untrusted://new-tab-page")==0||d.indexOf("moz-extension:")==
0)?t.__SAPISID:t.__APISID,f||typeof document==="undefined"||(f=new Ud,f=f.get(d?"SAPISID":"APISID")||f.get("__Secure-3PAPISID")),(f=f?Rd(f,d?"SAPISIDHASH":"APISIDHASH",c):null)&&e.push(f),d&&((d=Vd("__1PSAPISID","__Secure-1PAPISID","SAPISID1PHASH",c))&&e.push(d),(c=Vd("__3PSAPISID","__Secure-3PAPISID","SAPISID3PHASH",c))&&e.push(c)));if(e=e.length==0?null:e.join(" "))a.Authorization=e,e=b=b==null?void 0:b.sessionIndex,e===void 0&&(e=Number(R("SESSION_INDEX",0)),e=isNaN(e)?0:e),S("voice_search_auth_header_removal")||
(a["X-Goog-AuthUser"]=e.toString()),"INNERTUBE_HOST_OVERRIDE"in sf||(a["X-Origin"]=window.location.origin),b===void 0&&"DELEGATED_SESSION_ID"in sf&&(a["X-Goog-PageId"]=R("DELEGATED_SESSION_ID"));return a}
var eg=class{constructor(){this.Ma=!0}};var gg={identityType:"UNAUTHENTICATED_IDENTITY_TYPE_UNKNOWN"};function hg(a){switch(a){case "DESKTOP":return 1;case "UNKNOWN_PLATFORM":return 0;case "TV":return 2;case "GAME_CONSOLE":return 3;case "MOBILE":return 4;case "TABLET":return 5}}
;w("ytglobal.prefsUserPrefsPrefs_",v("ytglobal.prefsUserPrefsPrefs_")||{});function ig(){if(R("DATASYNC_ID")!==void 0)return R("DATASYNC_ID");throw new O("Datasync ID not set","unknown");}
;function jg(a,b){return kg(a,0,b)}
function lg(a){const b=v("yt.scheduler.instance.addImmediateJob");b?b(a):a()}
var mg=class{h(a){kg(a,1)}};function ng(){og.instance||(og.instance=new og);return og.instance}
function kg(a,b,c){c!==void 0&&Number.isNaN(Number(c))&&(c=void 0);const d=v("yt.scheduler.instance.addJob");return d?d(a,b,c):c===void 0?(a(),NaN):Hf(a,c||0)}
var og=class extends mg{R(a){if(a===void 0||!Number.isNaN(Number(a))){var b=v("yt.scheduler.instance.cancelJob");b?b(a):window.clearTimeout(a)}}start(){const a=v("yt.scheduler.instance.start");a&&a()}},pg=ng();const qg=[];let rg,sg=!1;function tg(a){sg||(rg?rg.handleError(a):(qg.push({type:"ERROR",payload:a}),qg.length>10&&qg.shift()))}
function ug(a,b){sg||(rg?rg.S(a,b):(qg.push({type:"EVENT",eventType:a,payload:b}),qg.length>10&&qg.shift()))}
;function vg(a){if(a.indexOf(":")>=0)throw Error("Database name cannot contain ':'");}
function wg(a){return a.substr(0,a.indexOf(":"))||a}
;const xg={AUTH_INVALID:"No user identifier specified.",EXPLICIT_ABORT:"Transaction was explicitly aborted.",IDB_NOT_SUPPORTED:"IndexedDB is not supported.",MISSING_INDEX:"Index not created.",MISSING_OBJECT_STORES:"Object stores not created.",DB_DELETED_BY_MISSING_OBJECT_STORES:"Database is deleted because expected object stores were not created.",DB_REOPENED_BY_MISSING_OBJECT_STORES:"Database is reopened because expected object stores were not created.",UNKNOWN_ABORT:"Transaction was aborted for unknown reasons.",
QUOTA_EXCEEDED:"The current transaction exceeded its quota limitations.",QUOTA_MAYBE_EXCEEDED:"The current transaction may have failed because of exceeding quota limitations.",EXECUTE_TRANSACTION_ON_CLOSED_DB:"Can't start a transaction on a closed database",INCOMPATIBLE_DB_VERSION:"The binary is incompatible with the database version"},yg={AUTH_INVALID:"ERROR",EXECUTE_TRANSACTION_ON_CLOSED_DB:"WARNING",EXPLICIT_ABORT:"IGNORED",IDB_NOT_SUPPORTED:"ERROR",MISSING_INDEX:"WARNING",MISSING_OBJECT_STORES:"ERROR",
DB_DELETED_BY_MISSING_OBJECT_STORES:"WARNING",DB_REOPENED_BY_MISSING_OBJECT_STORES:"WARNING",QUOTA_EXCEEDED:"WARNING",QUOTA_MAYBE_EXCEEDED:"WARNING",UNKNOWN_ABORT:"WARNING",INCOMPATIBLE_DB_VERSION:"WARNING"},zg={AUTH_INVALID:!1,EXECUTE_TRANSACTION_ON_CLOSED_DB:!1,EXPLICIT_ABORT:!1,IDB_NOT_SUPPORTED:!1,MISSING_INDEX:!1,MISSING_OBJECT_STORES:!1,DB_DELETED_BY_MISSING_OBJECT_STORES:!1,DB_REOPENED_BY_MISSING_OBJECT_STORES:!1,QUOTA_EXCEEDED:!1,QUOTA_MAYBE_EXCEEDED:!0,UNKNOWN_ABORT:!0,INCOMPATIBLE_DB_VERSION:!1};
var U=class extends O{constructor(a,b={},c=xg[a],d=yg[a],e=zg[a]){super(c,Object.assign({},{name:"YtIdbKnownError",isSw:self.document===void 0,isIframe:self!==self.top,type:a},b));this.type=a;this.message=c;this.level=d;this.h=e;Object.setPrototypeOf(this,U.prototype)}},Ag=class extends U{constructor(a,b){super("MISSING_OBJECT_STORES",{expectedObjectStores:b,foundObjectStores:a},xg.MISSING_OBJECT_STORES);Object.setPrototypeOf(this,Ag.prototype)}},Bg=class extends Error{constructor(a,b){super();this.index=
a;this.objectStore=b;Object.setPrototypeOf(this,Bg.prototype)}};const Cg=["The database connection is closing","Can't start a transaction on a closed database","A mutation operation was attempted on a database that did not allow mutations"];
function Dg(a,b,c,d){b=wg(b);let e;e=a instanceof Error?a:Error(`Unexpected error: ${a}`);if(e instanceof U)return e;a={objectStoreNames:c,dbName:b,dbVersion:d};if(e.name==="QuotaExceededError")return new U("QUOTA_EXCEEDED",a);if(Wa&&e.name==="UnknownError")return new U("QUOTA_MAYBE_EXCEEDED",a);if(e instanceof Bg)return new U("MISSING_INDEX",Object.assign({},a,{objectStore:e.objectStore,index:e.index}));if(e.name==="InvalidStateError"&&Cg.some(f=>e.message.includes(f)))return new U("EXECUTE_TRANSACTION_ON_CLOSED_DB",
a);
if(e.name==="AbortError")return new U("UNKNOWN_ABORT",a,e.message);e.args=[Object.assign({},a,{name:"IdbError",Fb:e.name})];e.level="WARNING";return e}
function Eg(a,b,c){return new U("IDB_NOT_SUPPORTED",{context:{caller:a,publicName:b,version:c,hasSucceededOnce:void 0}})}
;function Fg(a){if(!a)throw Error();throw a;}
function Gg(a){return a}
var Hg=class{constructor(a){this.h=a}};function Ig(a,b,c,d,e){try{if(a.state.status!=="FULFILLED")throw Error("calling handleResolve before the promise is fulfilled.");const f=c(a.state.value);f instanceof Jg?Kg(a,b,f,d,e):d(f)}catch(f){e(f)}}
function Lg(a,b,c,d,e){try{if(a.state.status!=="REJECTED")throw Error("calling handleReject before the promise is rejected.");const f=c(a.state.reason);f instanceof Jg?Kg(a,b,f,d,e):d(f)}catch(f){e(f)}}
function Kg(a,b,c,d,e){b===c?e(new TypeError("Circular promise chain detected.")):c.then(f=>{f instanceof Jg?Kg(a,b,f,d,e):d(f)},f=>{e(f)})}
var Jg=class{constructor(a){this.state={status:"PENDING"};this.h=[];this.i=[];a=a.h;const b=d=>{if(this.state.status==="PENDING"){this.state={status:"FULFILLED",value:d};for(const e of this.h)e()}},c=d=>{if(this.state.status==="PENDING"){this.state={status:"REJECTED",
reason:d};for(const e of this.i)e()}};
try{a(b,c)}catch(d){c(d)}}static all(a){return new Jg(new Hg((b,c)=>{const d=[];let e=a.length;e===0&&b(d);for(let f=0;f<a.length;++f)Jg.resolve(a[f]).then(g=>{d[f]=g;e--;e===0&&b(d)}).catch(g=>{c(g)})}))}static resolve(a){return new Jg(new Hg((b,c)=>{a instanceof Jg?a.then(b,c):b(a)}))}static reject(a){return new Jg(new Hg((b,c)=>{c(a)}))}then(a,b){const c=a!=null?a:Gg,d=b!=null?b:Fg;
return new Jg(new Hg((e,f)=>{this.state.status==="PENDING"?(this.h.push(()=>{Ig(this,this,c,e,f)}),this.i.push(()=>{Lg(this,this,d,e,f)})):this.state.status==="FULFILLED"?Ig(this,this,c,e,f):this.state.status==="REJECTED"&&Lg(this,this,d,e,f)}))}catch(a){return this.then(void 0,a)}};function Mg(a,b,c){const d=()=>{try{a.removeEventListener("success",e),a.removeEventListener("error",f)}catch(g){}},e=()=>{b(a.result);
d()},f=()=>{c(a.error);
d()};
a.addEventListener("success",e);a.addEventListener("error",f)}
function Ng(a){return new Promise((b,c)=>{Mg(a,b,c)})}
function V(a){return new Jg(new Hg((b,c)=>{Mg(a,b,c)}))}
;function Og(a,b){return new Jg(new Hg((c,d)=>{const e=()=>{const f=a?b(a):null;f?f.then(g=>{a=g;e()},d):c()};
e()}))}
;const Pg=window;var W=Pg.ytcsi&&Pg.ytcsi.now?Pg.ytcsi.now:Pg.performance&&Pg.performance.timing&&Pg.performance.now&&Pg.performance.timing.navigationStart?()=>Pg.performance.timing.navigationStart+Pg.performance.now():()=>(new Date).getTime();function X(a,b,c,d){return r(function*(){const e={mode:"readonly",A:!1,tag:"IDB_TRANSACTION_TAG_UNKNOWN"};typeof c==="string"?e.mode=c:Object.assign(e,c);a.transactionCount++;const f=e.A?3:1;let g=0,h;for(;!h;){g++;const p=Math.round(W());try{var k=a.h.transaction(b,e.mode),l=d;const n=new Qg(k),q=yield Rg(n,l),m=Math.round(W());Sg(a,p,m,g,void 0,b.join(),e);return q}catch(n){l=Math.round(W());const q=Dg(n,a.h.name,b.join(),a.h.version);if(q instanceof U&&!q.h||g>=f)Sg(a,p,l,g,q,b.join(),e),h=q}}return Promise.reject(h)})}
function Tg(a,b,c){a=a.h.createObjectStore(b,c);return new Ug(a)}
function Vg(a,b,c,d){return X(a,[b],{mode:"readwrite",A:!0},e=>{e=e.objectStore(b);return V(e.h.put(c,d))})}
function Sg(a,b,c,d,e,f,g){b=c-b;e?(e instanceof U&&(e.type==="QUOTA_EXCEEDED"||e.type==="QUOTA_MAYBE_EXCEEDED")&&ug("QUOTA_EXCEEDED",{dbName:wg(a.h.name),objectStoreNames:f,transactionCount:a.transactionCount,transactionMode:g.mode}),e instanceof U&&e.type==="UNKNOWN_ABORT"&&(c-=a.j,c<0&&c>=2147483648&&(c=0),ug("TRANSACTION_UNEXPECTEDLY_ABORTED",{objectStoreNames:f,transactionDuration:b,transactionCount:a.transactionCount,dbDuration:c}),a.i=!0),Wg(a,!1,d,f,b,g.tag),tg(e)):Wg(a,!0,d,f,b,g.tag)}
function Wg(a,b,c,d,e,f="IDB_TRANSACTION_TAG_UNKNOWN"){ug("TRANSACTION_ENDED",{objectStoreNames:d,connectionHasUnknownAbortedTransaction:a.i,duration:e,isSuccessful:b,tryCount:c,tag:f})}
var Xg=class{constructor(a,b){this.h=a;this.options=b;this.transactionCount=0;this.j=Math.round(W());this.i=!1}add(a,b,c){return X(this,[a],{mode:"readwrite",A:!0},d=>d.objectStore(a).add(b,c))}clear(a){return X(this,[a],{mode:"readwrite",
A:!0},b=>b.objectStore(a).clear())}close(){this.h.close();
let a;((a=this.options)==null?0:a.closed)&&this.options.closed()}count(a,b){return X(this,[a],{mode:"readonly",A:!0},c=>c.objectStore(a).count(b))}delete(a,b){return X(this,[a],{mode:"readwrite",
A:!0},c=>c.objectStore(a).delete(b))}get(a,b){return X(this,[a],{mode:"readonly",
A:!0},c=>c.objectStore(a).get(b))}getAll(a,b,c){return X(this,[a],{mode:"readonly",
A:!0},d=>d.objectStore(a).getAll(b,c))}objectStoreNames(){return Array.from(this.h.objectStoreNames)}getName(){return this.h.name}};
function Yg(a,b,c){a=a.h.openCursor(b.query,b.direction);return Zg(a).then(d=>Og(d,c))}
function $g(a,b){return Yg(a,{query:b},c=>c.delete().then(()=>ah(c))).then(()=>{})}
function bh(a,b,c){const d=[];return Yg(a,{query:b},e=>{if(!(c!==void 0&&d.length>=c))return d.push(e.cursor.value),ah(e)}).then(()=>d)}
var Ug=class{constructor(a){this.h=a}add(a,b){return V(this.h.add(a,b))}autoIncrement(){return this.h.autoIncrement}clear(){return V(this.h.clear()).then(()=>{})}count(a){return V(this.h.count(a))}delete(a){return a instanceof IDBKeyRange?$g(this,a):V(this.h.delete(a))}get(a){return V(this.h.get(a))}getAll(a,b){return"getAll"in IDBObjectStore.prototype?V(this.h.getAll(a,b)):bh(this,a,b)}index(a){try{return new ch(this.h.index(a))}catch(b){if(b instanceof Error&&b.name==="NotFoundError")throw new Bg(a,
this.h.name);
throw b;}}getName(){return this.h.name}keyPath(){return this.h.keyPath}};function Rg(a,b){const c=new Promise((d,e)=>{try{b(a).then(f=>{d(f)}).catch(e)}catch(f){e(f),a.abort()}});
return Promise.all([c,a.done]).then(([d])=>d)}
var Qg=class{constructor(a){this.h=a;this.j=new Map;this.i=!1;this.done=new Promise((b,c)=>{this.h.addEventListener("complete",()=>{b()});
this.h.addEventListener("error",d=>{d.currentTarget===d.target&&c(this.h.error)});
this.h.addEventListener("abort",()=>{var d=this.h.error;if(d)c(d);else if(!this.i){d=U;var e=this.h.objectStoreNames;const f=[];for(let g=0;g<e.length;g++){const h=e.item(g);if(h===null)throw Error("Invariant: item in DOMStringList is null");f.push(h)}d=new d("UNKNOWN_ABORT",{objectStoreNames:f.join(),dbName:this.h.db.name,mode:this.h.mode});c(d)}})})}abort(){this.h.abort();
this.i=!0;throw new U("EXPLICIT_ABORT");}objectStore(a){a=this.h.objectStore(a);let b=this.j.get(a);b||(b=new Ug(a),this.j.set(a,b));return b}};function dh(a,b,c){const {query:d=null,direction:e="next"}=b;a=a.h.openCursor(d,e);return Zg(a).then(f=>Og(f,c))}
function eh(a,b,c){const d=[];return dh(a,{query:b},e=>{if(!(c!==void 0&&d.length>=c))return d.push(e.cursor.value),ah(e)}).then(()=>d)}
var ch=class{constructor(a){this.h=a}count(a){return V(this.h.count(a))}delete(a){return dh(this,{query:a},b=>b.delete().then(()=>ah(b)))}get(a){return V(this.h.get(a))}getAll(a,b){return"getAll"in IDBIndex.prototype?V(this.h.getAll(a,b)):eh(this,a,b)}getKey(a){return V(this.h.getKey(a))}keyPath(){return this.h.keyPath}unique(){return this.h.unique}};
function Zg(a){return V(a).then(b=>b?new fh(a,b):null)}
function ah(a){a.cursor.continue(void 0);return Zg(a.request)}
function gh(a){a.cursor.advance(5);return Zg(a.request)}
var fh=class{constructor(a,b){this.request=a;this.cursor=b}delete(){return V(this.cursor.delete()).then(()=>{})}getKey(){return this.cursor.key}update(a){return V(this.cursor.update(a))}};function hh(a,b,c){return new Promise((d,e)=>{let f;f=b!==void 0?self.indexedDB.open(a,b):self.indexedDB.open(a);const g=c.xa,h=c.blocking,k=c.Na,l=c.upgrade,p=c.closed;let n;const q=()=>{n||(n=new Xg(f.result,{closed:p}));return n};
f.addEventListener("upgradeneeded",m=>{try{if(m.newVersion===null)throw Error("Invariant: newVersion on IDbVersionChangeEvent is null");if(f.transaction===null)throw Error("Invariant: transaction on IDbOpenDbRequest is null");m.dataLoss&&m.dataLoss!=="none"&&ug("IDB_DATA_CORRUPTED",{reason:m.dataLossMessage||"unknown reason",dbName:wg(a)});const u=q(),B=new Qg(f.transaction);l&&l(u,y=>m.oldVersion<y&&m.newVersion>=y,B);
B.done.catch(y=>{e(y)})}catch(u){e(u)}});
f.addEventListener("success",()=>{const m=f.result;h&&m.addEventListener("versionchange",()=>{h(q())});
m.addEventListener("close",()=>{ug("IDB_UNEXPECTEDLY_CLOSED",{dbName:wg(a),dbVersion:m.version});k&&k()});
d(q())});
f.addEventListener("error",()=>{e(f.error)});
g&&f.addEventListener("blocked",()=>{g()})})}
function ih(a,b,c={}){return hh(a,b,c)}
function jh(a,b={}){return r(function*(){try{const c=self.indexedDB.deleteDatabase(a),d=b.xa;d&&c.addEventListener("blocked",()=>{d()});
yield Ng(c)}catch(c){throw Dg(c,a,"",-1);}})}
;function kh(a,b){return new U("INCOMPATIBLE_DB_VERSION",{dbName:a.name,oldVersion:a.options.version,newVersion:b})}
function lh(a,b){if(!b)throw Eg("openWithToken",wg(a.name));return a.open()}
var mh=class{constructor(a,b){this.name=a;this.options=b;this.j=!0;this.m=this.l=0}i(a,b,c={}){return ih(a,b,c)}delete(a={}){return jh(this.name,a)}open(){if(!this.j)throw kh(this);if(this.h)return this.h;let a;const b=()=>{this.h===a&&(this.h=void 0)},c={blocking:e=>{e.close()},
closed:b,Na:b,upgrade:this.options.upgrade},d=()=>{const e=this;return r(function*(){var f,g=(f=Error().stack)!=null?f:"";try{const k=yield e.i(e.name,e.options.version,c);f=k;var h=e.options;const l=[];for(const p of Object.keys(h.M)){const {L:n,Kb:q=Number.MAX_VALUE}=h.M[p];!(f.h.version>=n)||f.h.version>=q||f.h.objectStoreNames.contains(p)||l.push(p)}if(l.length!==0){const p=Object.keys(e.options.M),n=k.objectStoreNames();if(e.m<T("ytidb_reopen_db_retries",0))return e.m++,k.close(),tg(new U("DB_REOPENED_BY_MISSING_OBJECT_STORES",
{dbName:e.name,expectedObjectStores:p,foundObjectStores:n})),d();if(e.l<T("ytidb_remake_db_retries",1))return e.l++,yield e.delete(),tg(new U("DB_DELETED_BY_MISSING_OBJECT_STORES",{dbName:e.name,expectedObjectStores:p,foundObjectStores:n})),d();throw new Ag(n,p);}return k}catch(k){if(k instanceof DOMException?k.name==="VersionError":"DOMError"in self&&k instanceof DOMError?k.name==="VersionError":k instanceof Object&&"message"in k&&k.message==="An attempt was made to open a database using a lower version than the existing version."){g=
yield e.i(e.name,void 0,Object.assign({},c,{upgrade:void 0}));h=g.h.version;if(e.options.version!==void 0&&h>e.options.version+1)throw g.close(),e.j=!1,kh(e,h);return g}b();k instanceof Error&&!S("ytidb_async_stack_killswitch")&&(k.stack=`${k.stack}\n${g.substring(g.indexOf("\n")+1)}`);let l;throw Dg(k,e.name,"",(l=e.options.version)!=null?l:-1);}})};
return this.h=a=d()}};const nh=new mh("YtIdbMeta",{M:{databases:{L:1}},upgrade(a,b){b(1)&&Tg(a,"databases",{keyPath:"actualName"})}});function oh(a,b){return r(function*(){return X(yield lh(nh,b),["databases"],{A:!0,mode:"readwrite"},c=>{const d=c.objectStore("databases");return d.get(a.actualName).then(e=>{if(e?a.actualName!==e.actualName||a.publicName!==e.publicName||a.userIdentifier!==e.userIdentifier:1)return V(d.h.put(a,void 0)).then(()=>{})})})})}
function ph(a,b){return r(function*(){if(a)return(yield lh(nh,b)).delete("databases",a)})}
;let qh;const rh=new class{constructor(){}}(new class{constructor(){}});function sh(){return r(function*(){return!0})}
function th(){if(qh!==void 0)return qh;sg=!0;return qh=sh().then(a=>{sg=!1;return a})}
function uh(){return v("ytglobal.idbToken_")||void 0}
function vh(){const a=uh();return a?Promise.resolve(a):th().then(b=>{(b=b?rh:void 0)&&w("ytglobal.idbToken_",b);return b})}
;new ze;function wh(a){try{ig();var b=!0}catch(c){b=!1}if(!b)throw a=new U("AUTH_INVALID",{dbName:a}),tg(a),a;b=ig();return{actualName:`${a}:${b}`,publicName:a,userIdentifier:b}}
function xh(a,b,c,d){return r(function*(){var e,f=(e=Error().stack)!=null?e:"";e=yield vh();if(!e)throw e=Eg("openDbImpl",a,b),S("ytidb_async_stack_killswitch")||(e.stack=`${e.stack}\n${f.substring(f.indexOf("\n")+1)}`),tg(e),e;vg(a);f=c?{actualName:a,publicName:a,userIdentifier:void 0}:wh(a);try{return yield oh(f,e),yield ih(f.actualName,b,d)}catch(g){try{yield ph(f.actualName,e)}catch(h){}throw g;}})}
function yh(a,b,c={}){return xh(a,b,!1,c)}
function zh(a,b,c={}){return xh(a,b,!0,c)}
function Ah(a,b={}){return r(function*(){const c=yield vh();if(c){vg(a);var d=wh(a);yield jh(d.actualName,b);yield ph(d.actualName,c)}})}
function Bh(a,b={}){return r(function*(){const c=yield vh();c&&(vg(a),yield jh(a,b),yield ph(a,c))})}
;function Ch(a,b){let c;return()=>{c||(c=new Dh(a,b));return c}}
var Dh=class extends mh{constructor(a,b){super(a,b);this.options=b;vg(a)}i(a,b,c={}){return(this.options.shared?zh:yh)(a,b,Object.assign({},c))}delete(a={}){return(this.options.shared?Bh:Ah)(this.name,a)}};function Eh(a,b){return Ch(a,b)}
;var Fh=Eh("ytGcfConfig",{M:{coldConfigStore:{L:1},hotConfigStore:{L:1}},shared:!1,upgrade(a,b){b(1)&&(Tg(a,"hotConfigStore",{keyPath:"key",autoIncrement:!0}).h.createIndex("hotTimestampIndex","timestamp",{unique:!1}),Tg(a,"coldConfigStore",{keyPath:"key",autoIncrement:!0}).h.createIndex("coldTimestampIndex","timestamp",{unique:!1}))},version:1});function Gh(a){return lh(Fh(),a)}
function Hh(a,b,c){return r(function*(){const d={config:a,hashData:b,timestamp:W()},e=yield Gh(c);yield e.clear("hotConfigStore");return yield Vg(e,"hotConfigStore",d)})}
function Ih(a,b,c,d){return r(function*(){const e={config:a,hashData:b,configData:c,timestamp:W()},f=yield Gh(d);yield f.clear("coldConfigStore");return yield Vg(f,"coldConfigStore",e)})}
function Jh(a){return r(function*(){let b=void 0;yield X(yield Gh(a),["coldConfigStore"],{mode:"readwrite",A:!0},c=>dh(c.objectStore("coldConfigStore").index("coldTimestampIndex"),{direction:"prev"},d=>{b=d.cursor.value}));
return b})}
function Kh(a){return r(function*(){let b=void 0;yield X(yield Gh(a),["hotConfigStore"],{mode:"readwrite",A:!0},c=>dh(c.objectStore("hotConfigStore").index("hotTimestampIndex"),{direction:"prev"},d=>{b=d.cursor.value}));
return b})}
;var Lh=class extends Xd{constructor(){super();this.j=[];this.h=[];const a=v("yt.gcf.config.hotUpdateCallbacks");a?(this.j=[...a],this.h=a):(this.h=[],w("yt.gcf.config.hotUpdateCallbacks",this.h))}m(){for(const b of this.j){var a=this.h;const c=a.indexOf(b);c>=0&&a.splice(c,1)}this.j.length=0;super.m()}};function Mh(a,b,c){return r(function*(){if(S("start_client_gcf")){c&&(a.j=c,w("yt.gcf.config.hotConfigGroup",a.j||null));a.hotHashData=b;w("yt.gcf.config.hotHashData",a.hotHashData||null);var d=uh();if(d){if(!c){var e;c=(e=yield Kh(d))==null?void 0:e.config}yield Hh(c,b,d)}if(c){d=a.i;e=c;for(const f of d.h)f(e)}}})}
function Nh(a,b,c){return r(function*(){if(S("start_client_gcf")){a.coldHashData=b;w("yt.gcf.config.coldHashData",a.coldHashData||null);const d=uh();if(d){if(!c){let e;c=(e=yield Jh(d))==null?void 0:e.config}c&&(yield Ih(c,b,c.configData,d))}}})}
var Oh=class{constructor(){this.h=0;this.i=new Lh}};function Ph(){return"INNERTUBE_API_KEY"in sf&&"INNERTUBE_API_VERSION"in sf}
function Qh(){return{innertubeApiKey:R("INNERTUBE_API_KEY"),innertubeApiVersion:R("INNERTUBE_API_VERSION"),Z:R("INNERTUBE_CONTEXT_CLIENT_CONFIG_INFO"),Ba:R("INNERTUBE_CONTEXT_CLIENT_NAME","WEB"),Ca:R("INNERTUBE_CONTEXT_CLIENT_NAME",1),innertubeContextClientVersion:R("INNERTUBE_CONTEXT_CLIENT_VERSION"),ka:R("INNERTUBE_CONTEXT_HL"),ja:R("INNERTUBE_CONTEXT_GL"),Da:R("INNERTUBE_HOST_OVERRIDE")||"",Ea:!!R("INNERTUBE_USE_THIRD_PARTY_AUTH",!1),Ab:!!R("INNERTUBE_OMIT_API_KEY_WHEN_AUTH_HEADER_IS_PRESENT",
!1),appInstallData:R("SERIALIZED_CLIENT_CONFIG_DATA")}}
function Rh(a){const b={client:{hl:a.ka,gl:a.ja,clientName:a.Ba,clientVersion:a.innertubeContextClientVersion,configInfo:a.Z}};navigator.userAgent&&(b.client.userAgent=String(navigator.userAgent));var c=t.devicePixelRatio;c&&c!=1&&(b.client.screenDensityFloat=String(c));c=Lf();c!==""&&(b.client.experimentsToken=c);c=Mf();c.length>0&&(b.request={internalExperimentFlags:c});Sh(void 0,b);Th(a,void 0,b);S("start_client_gcf")&&Uh(void 0,b);R("DELEGATED_SESSION_ID")&&!S("pageid_as_header_web")&&(b.user=
{onBehalfOfUser:R("DELEGATED_SESSION_ID")});!S("fill_delegate_context_in_gel_killswitch")&&(a=R("INNERTUBE_CONTEXT_SERIALIZED_DELEGATION_CONTEXT"))&&(b.user=Object.assign({},b.user,{serializedDelegationContext:a}));a=R("INNERTUBE_CONTEXT");var d;if(S("enable_persistent_device_token")&&(a==null?0:(d=a.client)==null?0:d.rolloutToken)){var e;b.client.rolloutToken=a==null?void 0:(e=a.client)==null?void 0:e.rolloutToken}d=Object;e=d.assign;a=b.client;var f=R("DEVICE","");c={};for(const [g,h]of Object.entries(Df(f))){f=
g;const k=h;f==="cbrand"?c.deviceMake=k:f==="cmodel"?c.deviceModel=k:f==="cbr"?c.browserName=k:f==="cbrver"?c.browserVersion=k:f==="cos"?c.osName=k:f==="cosver"?c.osVersion=k:f==="cplatform"&&(c.platform=k)}b.client=e.call(d,a,c);return b}
function Sh(a,b){const c=v("yt.embedded_player.embed_url");c&&(a?(b=Tc(a,Re,7)||new Re,J(b,4,c),H(a,Re,7,b)):b&&(b.thirdParty={embedUrl:c}))}
function Th(a,b,c){if(a.appInstallData)if(b){let d;c=(d=Tc(b,Ke,62))!=null?d:new Ke;J(c,6,a.appInstallData);H(b,Ke,62,c)}else c&&(c.client.configInfo=c.client.configInfo||{},c.client.configInfo.appInstallData=a.appInstallData)}
function Vh(a,b,c={}){let d={};R("EOM_VISITOR_DATA")?d={"X-Goog-EOM-Visitor-Id":R("EOM_VISITOR_DATA")}:d={"X-Goog-Visitor-Id":c.visitorData||R("VISITOR_DATA","")};if(b&&b.includes("www.youtube-nocookie.com"))return d;b=c.tb||R("AUTHORIZATION");b||(a?b=`Bearer ${v("gapi.auth.getToken")().sb}`:(a=fg(dg()),S("pageid_as_header_web")||delete a["X-Goog-PageId"],d=Object.assign({},d,a)));b&&(d.Authorization=b);return d}
function Uh(a,b){if(!Oh.instance){var c=new Oh;Oh.instance=c}c=Oh.instance;var d=W()-c.h;if(c.h!==0&&d<T("send_config_hash_timer"))c=void 0;else{d=v("yt.gcf.config.coldConfigData");var e=v("yt.gcf.config.hotHashData"),f=v("yt.gcf.config.coldHashData");d&&e&&f&&(c.h=W());c={coldConfigData:d,hotHashData:e,coldHashData:f}}if(d=c)if(e=d.coldConfigData,c=d.coldHashData,d=d.hotHashData,a){var g;b=(g=Tc(a,Ke,62))!=null?g:new Ke;g=J(b,1,e);g=J(g,3,c);J(g,5,d);H(a,Ke,62,b)}else b&&(b.client.configInfo=b.client.configInfo||
{},e&&(b.client.configInfo.coldConfigData=e),c&&(b.client.configInfo.coldHashData=c),d&&(b.client.configInfo.hotHashData=d))}
;typeof TextEncoder!=="undefined"&&new TextEncoder;function Wh(a){this.version=1;this.args=a}
;function Xh(){var a=Yh;this.topic="screen-created";this.h=a}
Xh.prototype.toString=function(){return this.topic};const Zh=v("ytPubsub2Pubsub2Instance")||new M;M.prototype.subscribe=M.prototype.K;M.prototype.unsubscribeByKey=M.prototype.C;M.prototype.publish=M.prototype.B;M.prototype.clear=M.prototype.clear;w("ytPubsub2Pubsub2Instance",Zh);const $h=v("ytPubsub2Pubsub2SubscribedKeys")||{};w("ytPubsub2Pubsub2SubscribedKeys",$h);const ai=v("ytPubsub2Pubsub2TopicToKeys")||{};w("ytPubsub2Pubsub2TopicToKeys",ai);const bi=v("ytPubsub2Pubsub2IsAsync")||{};w("ytPubsub2Pubsub2IsAsync",bi);
w("ytPubsub2Pubsub2SkipSubKey",null);function ci(a,b){const c=di();c&&c.publish.call(c,a.toString(),a,b)}
function ei(a){var b=fi;const c=di();if(!c)return 0;const d=c.subscribe(b.toString(),(e,f)=>{var g=v("ytPubsub2Pubsub2SkipSubKey");g&&g==d||(g=()=>{if($h[d])try{if(f&&b instanceof Xh&&b!=e)try{var h=b.h,k=f;if(!k.args||!k.version)throw Error("yt.pubsub2.Data.deserialize(): serializedData is incomplete.");try{if(!h.na){const m=new h;h.na=m.version}var l=h.na}catch(m){}if(!l||k.version!=l)throw Error("yt.pubsub2.Data.deserialize(): serializedData version is incompatible.");try{l=Reflect;var p=l.construct;
{var n=k.args;const m=n.length;if(m>0){const u=Array(m);for(k=0;k<m;k++)u[k]=n[k];var q=u}else q=[]}f=p.call(l,h,q)}catch(m){throw m.message="yt.pubsub2.Data.deserialize(): "+m.message,m;}}catch(m){throw m.message="yt.pubsub2.pubsub2 cross-binary conversion error for "+b.toString()+": "+m.message,m;}a.call(window,f)}catch(m){wf(m)}},bi[b.toString()]?v("yt.scheduler.instance")?pg.h(g):Hf(g,0):g())});
$h[d]=!0;ai[b.toString()]||(ai[b.toString()]=[]);ai[b.toString()].push(d);return d}
function gi(){var a=hi;const b=ei(function(c){a.apply(void 0,arguments);ii(b)});
return b}
function ii(a){const b=di();b&&(typeof a==="number"&&(a=[a]),va(a,c=>{b.unsubscribeByKey(c);delete $h[c]}))}
function di(){return v("ytPubsub2Pubsub2Instance")}
;let ji=void 0,ki=void 0;var li={accountStateChangeSignedIn:23,accountStateChangeSignedOut:24,delayedEventMetricCaptured:11,latencyActionBaselined:6,latencyActionInfo:7,latencyActionTicked:5,offlineTransferStatusChanged:2,offlineImageDownload:335,playbackStartStateChanged:9,systemHealthCaptured:3,mangoOnboardingCompleted:10,mangoPushNotificationReceived:230,mangoUnforkDbMigrationError:121,mangoUnforkDbMigrationSummary:122,mangoUnforkDbMigrationPreunforkDbVersionNumber:133,mangoUnforkDbMigrationPhoneMetadata:134,mangoUnforkDbMigrationPhoneStorage:135,
mangoUnforkDbMigrationStep:142,mangoAsyncApiMigrationEvent:223,mangoDownloadVideoResult:224,mangoHomepageVideoCount:279,mangoHomeV3State:295,mangoImageClientCacheHitEvent:273,sdCardStatusChanged:98,framesDropped:12,thumbnailHovered:13,deviceRetentionInfoCaptured:14,thumbnailLoaded:15,backToAppEvent:318,streamingStatsCaptured:17,offlineVideoShared:19,appCrashed:20,youThere:21,offlineStateSnapshot:22,mdxSessionStarted:25,mdxSessionConnected:26,mdxSessionDisconnected:27,bedrockResourceConsumptionSnapshot:28,
nextGenWatchWatchSwiped:29,kidsAccountsSnapshot:30,zeroStepChannelCreated:31,tvhtml5SearchCompleted:32,offlineSharePairing:34,offlineShareUnlock:35,mdxRouteDistributionSnapshot:36,bedrockRepetitiveActionTimed:37,unpluggedDegradationInfo:229,uploadMp4HeaderMoved:38,uploadVideoTranscoded:39,uploadProcessorStarted:46,uploadProcessorEnded:47,uploadProcessorReady:94,uploadProcessorRequirementPending:95,uploadProcessorInterrupted:96,uploadFrontendEvent:241,assetPackDownloadStarted:41,assetPackDownloaded:42,
assetPackApplied:43,assetPackDeleted:44,appInstallAttributionEvent:459,playbackSessionStopped:45,adBlockerMessagingShown:48,distributionChannelCaptured:49,dataPlanCpidRequested:51,detailedNetworkTypeCaptured:52,sendStateUpdated:53,receiveStateUpdated:54,sendDebugStateUpdated:55,receiveDebugStateUpdated:56,kidsErrored:57,mdxMsnSessionStatsFinished:58,appSettingsCaptured:59,mdxWebSocketServerHttpError:60,mdxWebSocketServer:61,startupCrashesDetected:62,coldStartInfo:435,offlinePlaybackStarted:63,liveChatMessageSent:225,
liveChatUserPresent:434,liveChatBeingModerated:457,liveCreationCameraUpdated:64,liveCreationEncodingCaptured:65,liveCreationError:66,liveCreationHealthUpdated:67,liveCreationVideoEffectsCaptured:68,liveCreationStageOccured:75,liveCreationBroadcastScheduled:123,liveCreationArchiveReplacement:149,liveCreationCostreamingConnection:421,liveCreationStreamWebrtcStats:288,mdxSessionRecoveryStarted:69,mdxSessionRecoveryCompleted:70,mdxSessionRecoveryStopped:71,visualElementShown:72,visualElementHidden:73,
visualElementGestured:78,visualElementStateChanged:208,screenCreated:156,playbackAssociated:202,visualElementAttached:215,playbackContextEvent:214,cloudCastingPlaybackStarted:74,webPlayerApiCalled:76,tvhtml5AccountDialogOpened:79,foregroundHeartbeat:80,foregroundHeartbeatScreenAssociated:111,kidsOfflineSnapshot:81,mdxEncryptionSessionStatsFinished:82,playerRequestCompleted:83,liteSchedulerStatistics:84,mdxSignIn:85,spacecastMetadataLookupRequested:86,spacecastBatchLookupRequested:87,spacecastSummaryRequested:88,
spacecastPlayback:89,spacecastDiscovery:90,tvhtml5LaunchUrlComponentChanged:91,mdxBackgroundPlaybackRequestCompleted:92,mdxBrokenAdditionalDataDeviceDetected:93,tvhtml5LocalStorage:97,tvhtml5DeviceStorageStatus:147,autoCaptionsAvailable:99,playbackScrubbingEvent:339,flexyState:100,interfaceOrientationCaptured:101,mainAppBrowseFragmentCache:102,offlineCacheVerificationFailure:103,offlinePlaybackExceptionDigest:217,vrCopresenceStats:104,vrCopresenceSyncStats:130,vrCopresenceCommsStats:137,vrCopresencePartyStats:153,
vrCopresenceEmojiStats:213,vrCopresenceEvent:141,vrCopresenceFlowTransitEvent:160,vrCowatchPartyEvent:492,vrCowatchUserStartOrJoinEvent:504,vrPlaybackEvent:345,kidsAgeGateTracking:105,offlineDelayAllowedTracking:106,mainAppAutoOfflineState:107,videoAsThumbnailDownload:108,videoAsThumbnailPlayback:109,liteShowMore:110,renderingError:118,kidsProfilePinGateTracking:119,abrTrajectory:124,scrollEvent:125,streamzIncremented:126,kidsProfileSwitcherTracking:127,kidsProfileCreationTracking:129,buyFlowStarted:136,
mbsConnectionInitiated:138,mbsPlaybackInitiated:139,mbsLoadChildren:140,liteProfileFetcher:144,mdxRemoteTransaction:146,reelPlaybackError:148,reachabilityDetectionEvent:150,mobilePlaybackEvent:151,courtsidePlayerStateChanged:152,musicPersistentCacheChecked:154,musicPersistentCacheCleared:155,playbackInterrupted:157,playbackInterruptionResolved:158,fixFopFlow:159,anrDetection:161,backstagePostCreationFlowEnded:162,clientError:163,gamingAccountLinkStatusChanged:164,liteHousewarming:165,buyFlowEvent:167,
kidsParentalGateTracking:168,kidsSignedOutSettingsStatus:437,kidsSignedOutPauseHistoryFixStatus:438,tvhtml5WatchdogViolation:444,ypcUpgradeFlow:169,yongleStudy:170,ypcUpdateFlowStarted:171,ypcUpdateFlowCancelled:172,ypcUpdateFlowSucceeded:173,ypcUpdateFlowFailed:174,liteGrowthkitPromo:175,paymentFlowStarted:341,transactionFlowShowPaymentDialog:405,transactionFlowStarted:176,transactionFlowSecondaryDeviceStarted:222,transactionFlowSecondaryDeviceSignedOutStarted:383,transactionFlowCancelled:177,transactionFlowPaymentCallBackReceived:387,
transactionFlowPaymentSubmitted:460,transactionFlowPaymentSucceeded:329,transactionFlowSucceeded:178,transactionFlowFailed:179,transactionFlowPlayBillingConnectionStartEvent:428,transactionFlowSecondaryDeviceSuccess:458,transactionFlowErrorEvent:411,liteVideoQualityChanged:180,watchBreakEnablementSettingEvent:181,watchBreakFrequencySettingEvent:182,videoEffectsCameraPerformanceMetrics:183,adNotify:184,startupTelemetry:185,playbackOfflineFallbackUsed:186,outOfMemory:187,ypcPauseFlowStarted:188,ypcPauseFlowCancelled:189,
ypcPauseFlowSucceeded:190,ypcPauseFlowFailed:191,uploadFileSelected:192,ypcResumeFlowStarted:193,ypcResumeFlowCancelled:194,ypcResumeFlowSucceeded:195,ypcResumeFlowFailed:196,adsClientStateChange:197,ypcCancelFlowStarted:198,ypcCancelFlowCancelled:199,ypcCancelFlowSucceeded:200,ypcCancelFlowFailed:201,ypcCancelFlowGoToPaymentProcessor:402,ypcDeactivateFlowStarted:320,ypcRedeemFlowStarted:203,ypcRedeemFlowCancelled:204,ypcRedeemFlowSucceeded:205,ypcRedeemFlowFailed:206,ypcFamilyCreateFlowStarted:258,
ypcFamilyCreateFlowCancelled:259,ypcFamilyCreateFlowSucceeded:260,ypcFamilyCreateFlowFailed:261,ypcFamilyManageFlowStarted:262,ypcFamilyManageFlowCancelled:263,ypcFamilyManageFlowSucceeded:264,ypcFamilyManageFlowFailed:265,restoreContextEvent:207,embedsAdEvent:327,autoplayTriggered:209,clientDataErrorEvent:210,experimentalVssValidation:211,tvhtml5TriggeredEvent:212,tvhtml5FrameworksFieldTrialResult:216,tvhtml5FrameworksFieldTrialStart:220,musicOfflinePreferences:218,watchTimeSegment:219,appWidthLayoutError:221,
accountRegistryChange:226,userMentionAutoCompleteBoxEvent:227,downloadRecommendationEnablementSettingEvent:228,musicPlaybackContentModeChangeEvent:231,offlineDbOpenCompleted:232,kidsFlowEvent:233,kidsFlowCorpusSelectedEvent:234,videoEffectsEvent:235,unpluggedOpsEogAnalyticsEvent:236,playbackAudioRouteEvent:237,interactionLoggingDebugModeError:238,offlineYtbRefreshed:239,kidsFlowError:240,musicAutoplayOnLaunchAttempted:242,deviceContextActivityEvent:243,deviceContextEvent:244,templateResolutionException:245,
musicSideloadedPlaylistServiceCalled:246,embedsStorageAccessNotChecked:247,embedsHasStorageAccessResult:248,embedsItpPlayedOnReload:249,embedsRequestStorageAccessResult:250,embedsShouldRequestStorageAccessResult:251,embedsRequestStorageAccessState:256,embedsRequestStorageAccessFailedState:257,embedsItpWatchLaterResult:266,searchSuggestDecodingPayloadFailure:252,siriShortcutActivated:253,tvhtml5KeyboardPerformance:254,latencyActionSpan:255,elementsLog:267,ytbFileOpened:268,tfliteModelError:269,apiTest:270,
yongleUsbSetup:271,touStrikeInterstitialEvent:272,liteStreamToSave:274,appBundleClientEvent:275,ytbFileCreationFailed:276,adNotifyFailure:278,ytbTransferFailed:280,blockingRequestFailed:281,liteAccountSelector:282,liteAccountUiCallbacks:283,dummyPayload:284,browseResponseValidationEvent:285,entitiesError:286,musicIosBackgroundFetch:287,mdxNotificationEvent:289,layersValidationError:290,musicPwaInstalled:291,liteAccountCleanup:292,html5PlayerHealthEvent:293,watchRestoreAttempt:294,liteAccountSignIn:296,
notaireEvent:298,kidsVoiceSearchEvent:299,adNotifyFilled:300,delayedEventDropped:301,analyticsSearchEvent:302,systemDarkThemeOptOutEvent:303,flowEvent:304,networkConnectivityBaselineEvent:305,ytbFileImported:306,downloadStreamUrlExpired:307,directSignInEvent:308,lyricImpressionEvent:309,accessibilityStateEvent:310,tokenRefreshEvent:311,genericAttestationExecution:312,tvhtml5VideoSeek:313,unpluggedAutoPause:314,scrubbingEvent:315,bedtimeReminderEvent:317,tvhtml5UnexpectedRestart:319,tvhtml5StabilityTraceEvent:478,
tvhtml5OperationHealth:467,tvhtml5WatchKeyEvent:321,voiceLanguageChanged:322,tvhtml5LiveChatStatus:323,parentToolsCorpusSelectedEvent:324,offerAdsEnrollmentInitiated:325,networkQualityIntervalEvent:326,deviceStartupMetrics:328,heartbeatActionPlayerTransitioned:330,tvhtml5Lifecycle:331,heartbeatActionPlayerHalted:332,adaptiveInlineMutedSettingEvent:333,mainAppLibraryLoadingState:334,thirdPartyLogMonitoringEvent:336,appShellAssetLoadReport:337,tvhtml5AndroidAttestation:338,tvhtml5StartupSoundEvent:340,
iosBackgroundRefreshTask:342,iosBackgroundProcessingTask:343,sliEventBatch:344,postImpressionEvent:346,musicSideloadedPlaylistExport:347,idbUnexpectedlyClosed:348,voiceSearchEvent:349,mdxSessionCastEvent:350,idbQuotaExceeded:351,idbTransactionEnded:352,idbTransactionAborted:353,tvhtml5KeyboardLogging:354,idbIsSupportedCompleted:355,creatorStudioMobileEvent:356,idbDataCorrupted:357,parentToolsAppChosenEvent:358,webViewBottomSheetResized:359,activeStateControllerScrollPerformanceSummary:360,navigatorValidation:361,
mdxSessionHeartbeat:362,clientHintsPolyfillDiagnostics:363,clientHintsPolyfillEvent:364,proofOfOriginTokenError:365,kidsAddedAccountSummary:366,musicWearableDevice:367,ypcRefundFlowEvent:368,tvhtml5PlaybackMeasurementEvent:369,tvhtml5WatermarkMeasurementEvent:370,clientExpGcfPropagationEvent:371,mainAppReferrerIntent:372,leaderLockEnded:373,leaderLockAcquired:374,googleHatsEvent:375,persistentLensLaunchEvent:376,parentToolsChildWelcomeChosenEvent:378,browseThumbnailPreloadEvent:379,finalPayload:380,
mdxDialAdditionalDataUpdateEvent:381,webOrchestrationTaskLifecycleRecord:382,startupSignalEvent:384,accountError:385,gmsDeviceCheckEvent:386,accountSelectorEvent:388,accountUiCallbacks:389,mdxDialAdditionalDataProbeEvent:390,downloadsSearchIcingApiStats:391,downloadsSearchIndexUpdatedEvent:397,downloadsSearchIndexSnapshot:398,dataPushClientEvent:392,kidsCategorySelectedEvent:393,mdxDeviceManagementSnapshotEvent:394,prefetchRequested:395,prefetchableCommandExecuted:396,gelDebuggingEvent:399,webLinkTtsPlayEnd:400,
clipViewInvalid:401,persistentStorageStateChecked:403,cacheWipeoutEvent:404,playerEvent:410,sfvEffectPipelineStartedEvent:412,sfvEffectPipelinePausedEvent:429,sfvEffectPipelineEndedEvent:413,sfvEffectChosenEvent:414,sfvEffectLoadedEvent:415,sfvEffectUserInteractionEvent:465,sfvEffectFirstFrameProcessedLatencyEvent:416,sfvEffectAggregatedFramesProcessedLatencyEvent:417,sfvEffectAggregatedFramesDroppedEvent:418,sfvEffectPipelineErrorEvent:430,sfvEffectGraphFrozenEvent:419,sfvEffectGlThreadBlockedEvent:420,
mdeQosEvent:510,mdeVideoChangedEvent:442,mdePlayerPerformanceMetrics:472,mdeExporterEvent:497,genericClientExperimentEvent:423,homePreloadTaskScheduled:424,homePreloadTaskExecuted:425,homePreloadCacheHit:426,polymerPropertyChangedInObserver:427,applicationStarted:431,networkCronetRttBatch:432,networkCronetRttSummary:433,repeatChapterLoopEvent:436,seekCancellationEvent:462,lockModeTimeoutEvent:483,externalVideoShareToYoutubeAttempt:501,parentCodeEvent:502,offlineTransferStarted:4,musicOfflineMixtapePreferencesChanged:16,
mangoDailyNewVideosNotificationAttempt:40,mangoDailyNewVideosNotificationError:77,dtwsPlaybackStarted:112,dtwsTileFetchStarted:113,dtwsTileFetchCompleted:114,dtwsTileFetchStatusChanged:145,dtwsKeyframeDecoderBufferSent:115,dtwsTileUnderflowedOnNonkeyframe:116,dtwsBackfillFetchStatusChanged:143,dtwsBackfillUnderflowed:117,dtwsAdaptiveLevelChanged:128,blockingVisitorIdTimeout:277,liteSocial:18,mobileJsInvocation:297,biscottiBasedDetection:439,coWatchStateChange:440,embedsVideoDataDidChange:441,shortsFirst:443,
cruiseControlEvent:445,qoeClientLoggingContext:446,atvRecommendationJobExecuted:447,tvhtml5UserFeedback:448,producerProjectCreated:449,producerProjectOpened:450,producerProjectDeleted:451,producerProjectElementAdded:453,producerProjectElementRemoved:454,producerAppStateChange:509,producerProjectDiskInsufficientExportFailure:516,tvhtml5ShowClockEvent:455,deviceCapabilityCheckMetrics:456,youtubeClearcutEvent:461,offlineBrowseFallbackEvent:463,getCtvTokenEvent:464,startupDroppedFramesSummary:466,screenshotEvent:468,
miniAppPlayEvent:469,elementsDebugCounters:470,fontLoadEvent:471,webKillswitchReceived:473,webKillswitchExecuted:474,cameraOpenEvent:475,manualSmoothnessMeasurement:476,tvhtml5AppQualityEvent:477,polymerPropertyAccessEvent:479,miniAppSdkUsage:480,cobaltTelemetryEvent:481,crossDevicePlayback:482,channelCreatedWithObakeImage:484,channelEditedWithObakeImage:485,offlineDeleteEvent:486,crossDeviceNotificationTransfer:487,androidIntentEvent:488,unpluggedAmbientInterludesCounterfactualEvent:489,keyPlaysPlayback:490,
shortsCreationFallbackEvent:493,vssData:491,castMatch:494,miniAppPerformanceMetrics:495,userFeedbackEvent:496,kidsGuestSessionMismatch:498,musicSideloadedPlaylistMigrationEvent:499,sleepTimerSessionFinishEvent:500,watchEpPromoConflict:503,innertubeResponseCacheMetrics:505,miniAppAdEvent:506,dataPlanUpsellEvent:507,producerProjectRenamed:508,producerMediaSelectionEvent:511,embedsAutoplayStatusChanged:512,remoteConnectEvent:513,connectedSessionMisattributionEvent:514,producerProjectElementModified:515};const mi=["client.name","client.version"];function ni(a){if(!a.errorMetadata||!a.errorMetadata.kvPairs)return a;a.errorMetadata.kvPairs=a.errorMetadata.kvPairs.filter(b=>b.key?mi.includes(b.key):!1);
return a}
;var oi=Eh("ServiceWorkerLogsDatabase",{M:{SWHealthLog:{L:1}},shared:!0,upgrade:(a,b)=>{b(1)&&Tg(a,"SWHealthLog",{keyPath:"id",autoIncrement:!0}).h.createIndex("swHealthNewRequest",["interface","timestamp"],{unique:!1})},
version:1});function pi(a,b){return r(function*(){var c=yield lh(oi(),b),d=R("INNERTUBE_CONTEXT_CLIENT_NAME",0);const e=Object.assign({},a);e.clientError&&(e.clientError=ni(e.clientError));e.interface=d;return Vg(c,"SWHealthLog",e)})}
;w("ytNetworklessLoggingInitializationOptions",t.ytNetworklessLoggingInitializationOptions||{isNwlInitialized:!1});function qi(a,b,c,d){!R("VISITOR_DATA")&&b!=="visitor_id"&&Math.random()<.01&&xf(new O("Missing VISITOR_DATA when sending innertube request.",b,c,d));if(!a.isReady())throw a=new O("innertube xhrclient not ready",b,c,d),wf(a),a;c={headers:d.headers||{},method:"POST",postParams:c,postBody:d.postBody,postBodyFormat:d.postBodyFormat||"JSON",onTimeout:()=>{d.onTimeout()},
onFetchTimeout:d.onTimeout,onSuccess:(h,k)=>{if(d.onSuccess)d.onSuccess(k)},
onFetchSuccess:h=>{if(d.onSuccess)d.onSuccess(h)},
onError:(h,k)=>{if(d.onError)d.onError(k)},
onFetchError:h=>{if(d.onError)d.onError(h)},
timeout:d.timeout,withCredentials:!0,compress:d.compress};c.headers["Content-Type"]||(c.headers["Content-Type"]="application/json");let e="";var f=a.config_.Da;f&&(e=f);f=a.config_.Ea||!1;const g=Vh(f,e,d);Object.assign(c.headers,g);c.headers.Authorization&&!e&&f&&(c.headers["x-origin"]=window.location.origin);a=Ef(`${e}${`/${"youtubei"}/${a.config_.innertubeApiVersion}/${b}`}`,{alt:"json"});try{Of(a,c)}catch(h){if(h.name==="InvalidAccessError")xf(Error("An extension is blocking network request."));
else throw h;}}
var ri=class{constructor(a){this.config_=null;a?this.config_=a:Ph()&&(this.config_=Qh())}isReady(){!this.config_&&Ph()&&(this.config_=Qh());return!!this.config_}};let si=0;w("ytDomDomGetNextId",v("ytDomDomGetNextId")||(()=>++si));w("ytEventsEventsListeners",t.ytEventsEventsListeners||{});w("ytEventsEventsCounter",t.ytEventsEventsCounter||{count:0});t.ytPubsubPubsubInstance||new M;var ti=Symbol("injectionDeps"),ui=class{constructor(){this.name="INNERTUBE_TRANSPORT_TOKEN"}toString(){return`InjectionToken(${this.name})`}},vi=class{constructor(){this.key=Oh}};function wi(a){var b={da:xi,ma:yi.instance};a.i.set(b.da,b);const c=a.j.get(b.da);if(c)try{c.Nb(a.resolve(b.da))}catch(d){c.Jb(d)}}
function zi(a,b,c,d=!1){if(c.indexOf(b)>-1)throw Error(`Deps cycle for: ${b}`);if(a.h.has(b))return a.h.get(b);if(!a.i.has(b)){if(d)return;throw Error(`No provider for: ${b}`);}d=a.i.get(b);c.push(b);if(d.ma!==void 0)var e=d.ma;else if(d.Pa)e=d[ti]?Ai(a,d[ti],c):[],e=d.Pa(...e);else if(d.Oa){e=d.Oa;const f=e[ti]?Ai(a,e[ti],c):[];e=new e(...f)}else throw Error(`Could not resolve providers for: ${b}`);c.pop();d.Ub||a.h.set(b,e);return e}
function Ai(a,b,c){return b?b.map(d=>d instanceof vi?zi(a,d.key,c,!0):zi(a,d,c)):[]}
var Bi=class{constructor(){this.i=new Map;this.j=new Map;this.h=new Map}resolve(a){return a instanceof vi?zi(this,a.key,[],!0):zi(this,a,[])}};let Ci;function Di(){Ci||(Ci=new Bi);return Ci}
;let Ei=window;function Fi(){let a,b;return"h5vcc"in Ei&&((a=Ei.h5vcc.traceEvent)==null?0:a.traceBegin)&&((b=Ei.h5vcc.traceEvent)==null?0:b.traceEnd)?1:"performance"in Ei&&Ei.performance.mark&&Ei.performance.measure?2:0}
function Gi(a){const b=Fi();switch(b){case 1:Ei.h5vcc.traceEvent.traceBegin("YTLR",a);break;case 2:Ei.performance.mark(`${a}-start`);break;case 0:break;default:ua(b,"unknown trace type")}}
function Hi(a){var b=Fi();switch(b){case 1:Ei.h5vcc.traceEvent.traceEnd("YTLR",a);break;case 2:b=`${a}-start`;const c=`${a}-end`;Ei.performance.mark(c);Ei.performance.measure(a,b,c);break;case 0:break;default:ua(b,"unknown trace type")}}
;var Ii=S("web_enable_lifecycle_monitoring")&&Fi()!==0,Ji=S("web_enable_lifecycle_monitoring");function Ki(a){let b,c;(c=(b=window).onerror)==null||c.call(b,a.message,"",0,0,a)}
;function Li(a){let b;return(b=a.priority)!=null?b:0}
function Mi(a){var b=Array.from(a.h.keys()).sort((c,d)=>Li(a.h[d])-Li(a.h[c]));
for(const c of b)b=a.h[c],b.jobId===void 0||b.V||(a.scheduler.R(b.jobId),kg(b.aa,10))}
var Ni=class{constructor(a){this.scheduler=ng();this.i=new ze;this.h=a;for(let b=0;b<this.h.length;b++){const c=this.h[b];a=()=>{c.aa();this.h[b].V=!0;this.h.every(e=>e.V===!0)&&this.i.resolve()};
const d=kg(a,Li(c));this.h[b]=Object.assign({},c,{aa:a,jobId:d})}}cancel(){for(const a of this.h)a.jobId===void 0||a.V||this.scheduler.R(a.jobId),a.V=!0;this.i.resolve()}};function Oi(a,b,c){Ji&&console.groupCollapsed&&console.groupEnd&&(console.groupCollapsed(`[${a.constructor.name}] '${a.state}' to '${b}'`),console.log("with message: ",c),console.groupEnd())}
function Pi(a,b){const c=b.filter(e=>Qi(a,e)===10),d=b.filter(e=>Qi(a,e)!==10);
return a.l.Sb?(...e)=>r(function*(){yield Ri(c,...e);Si(a,d,...e)}):(...e)=>{Ti(c,...e);
Si(a,d,...e)}}
function Qi(a,b){let c,d;return(d=(c=a.j)!=null?c:b.priority)!=null?d:0}
function Ri(a,...b){return r(function*(){ng();for(const c of a){let d;lg(()=>{Ui(c.name);const e=Vi(()=>c.callback(...b));
Qb(e)?d=S("web_lifecycle_error_handling_killswitch")?e.then(()=>{Wi(c.name)}):e.then(()=>{Wi(c.name)},f=>{Ki(f);
Wi(c.name)}):Wi(c.name)});
d&&(yield d)}})}
function Si(a,b,...c){b=b.map(d=>({aa:()=>{Ui(d.name);Vi(()=>d.callback(...c));
Wi(d.name)},
priority:Qi(a,d)}));
b.length&&(a.i=new Ni(b))}
function Ti(a,...b){ng();for(const c of a)lg(()=>{Ui(c.name);Vi(()=>c.callback(...b));
Wi(c.name)})}
function Ui(a){Ii&&a&&Gi(a)}
function Wi(a){Ii&&a&&Hi(a)}
var Xi=class{constructor(){this.state="none";this.plugins=[];this.j=void 0;this.l={};Ii&&Gi(this.state)}get currentState(){return this.state}install(a){this.plugins.push(a);return this}transition(a,b){Ii&&Hi(this.state);var c=this.transitions.find(d=>Array.isArray(d.from)?d.from.find(e=>e===this.state&&d.P===a):d.from===this.state&&d.P===a);
if(c){this.i&&(Mi(this.i),this.i=void 0);Oi(this,a,b);this.state=a;Ii&&Gi(this.state);c=c.action.bind(this);const d=this.plugins.filter(e=>e[a]).map(e=>e[a]);
c(Pi(this,d),b)}else throw Error(`no transition specified from ${this.state} to ${a}`);}};function Vi(a){if(S("web_lifecycle_error_handling_killswitch"))return a();try{return a()}catch(b){Ki(b)}}
;function Yi(){Zi||(Zi=new $i);return Zi}
var $i=class extends Xi{constructor(){super();this.h=null;this.j=10;this.transitions=[{from:"none",P:"application_navigating",action:this.m},{from:"application_navigating",P:"none",action:this.s},{from:"application_navigating",P:"application_navigating",action:()=>{}},
{from:"none",P:"none",action:()=>{}}]}m(a,b){this.h=jg(()=>{this.currentState==="application_navigating"&&this.transition("none")},5E3);
a(b==null?void 0:b.event)}s(a,b){this.h&&(pg.R(this.h),this.h=null);a(b==null?void 0:b.event)}},Zi;let aj=[];w("yt.logging.transport.getScrapedGelPayloads",function(){return aj});function bj(a,b){const c=cj(b);if(a.h[c])return a.h[c];const d=Object.keys(a.store)||[];if(d.length<=1&&cj(b)===d[0])return d;const e=[];for(let g=0;g<d.length;g++){const h=d[g].split("/");if(dj(b.auth,h[0])){var f=b.isJspb;dj(f===void 0?"undefined":f?"true":"false",h[1])&&dj(b.cttAuthInfo,h[2])&&(f=b.tier,f=f===void 0?"undefined":JSON.stringify(f),dj(f,h[3])&&e.push(d[g]))}}return a.h[c]=e}
function dj(a,b){return a===void 0||a==="undefined"?!0:a===b}
var ej=class{constructor(){this.store={};this.h={}}storePayload(a,b){a=cj(a);this.store[a]?this.store[a].push(b):(this.h={},this.store[a]=[b]);S("more_accurate_gel_parser")&&(b=new CustomEvent("TRANSPORTING_NEW_EVENT"),window.dispatchEvent(b));return a}smartExtractMatchingEntries(a){if(!a.keys.length)return[];const b=bj(this,a.keys.splice(0,1)[0]),c=[];for(let d=0;d<b.length;d++)this.store[b[d]]&&a.sizeLimit&&(this.store[b[d]].length<=a.sizeLimit?(c.push(...this.store[b[d]]),delete this.store[b[d]]):
c.push(...this.store[b[d]].splice(0,a.sizeLimit)));(a==null?0:a.sizeLimit)&&c.length<(a==null?void 0:a.sizeLimit)&&(a.sizeLimit-=c.length,c.push(...this.smartExtractMatchingEntries(a)));return c}extractMatchingEntries(a){a=bj(this,a);const b=[];for(let c=0;c<a.length;c++)this.store[a[c]]&&(b.push(...this.store[a[c]]),delete this.store[a[c]]);return b}getSequenceCount(a){a=bj(this,a);let b=0;for(let c=0;c<a.length;c++){let d;b+=((d=this.store[a[c]])==null?void 0:d.length)||0}return b}};
ej.prototype.getSequenceCount=ej.prototype.getSequenceCount;ej.prototype.extractMatchingEntries=ej.prototype.extractMatchingEntries;ej.prototype.smartExtractMatchingEntries=ej.prototype.smartExtractMatchingEntries;ej.prototype.storePayload=ej.prototype.storePayload;function cj(a){return[a.auth===void 0?"undefined":a.auth,a.isJspb===void 0?"undefined":a.isJspb,a.cttAuthInfo===void 0?"undefined":a.cttAuthInfo,a.tier===void 0?"undefined":a.tier].join("/")}
;function fj(a,b){if(a)return a[b.name]}
;const gj=T("initial_gel_batch_timeout",2E3),hj=T("gel_queue_timeout_max_ms",6E4),ij=T("gel_min_batch_size",5);let jj=void 0;class kj{constructor(){this.l=this.h=this.i=0;this.j=!1}}const lj=new kj,mj=new kj,nj=new kj,oj=new kj;let pj,qj=!0,rj=1;const sj=new Map,tj=t.ytLoggingTransportTokensToCttTargetIds_||{},uj=t.ytLoggingTransportTokensToJspbCttTargetIds_||{};let vj={};function wj(){let a=v("yt.logging.ims");a||(a=new ej,w("yt.logging.ims",a));return a}
function xj(a,b){if(a.endpoint==="log_event"){yj();var c=zj(a),d=Aj(a.payload)||"";a:{if(S("enable_web_tiered_gel")){var e=li[d||""];var f,g;if(Di().resolve(new vi)==null)var h=void 0;else{let k;h=(k=v("yt.gcf.config.hotConfigGroup"))!=null?k:R("RAW_HOT_CONFIG_GROUP");h=h==null?void 0:(f=h.loggingHotConfig)==null?void 0:(g=f.eventLoggingConfig)==null?void 0:g.payloadPolicies}if(f=h)for(g=0;g<f.length;g++)if(f[g].payloadNumber===e){e=f[g];break a}}e=void 0}f=200;if(e){if(e.enabled===!1&&!S("web_payload_policy_disabled_killswitch"))return;
f=Bj(e.tier);if(f===400){Cj(a,b);return}}vj[c]=!0;c={cttAuthInfo:c,isJspb:!1,tier:f};wj().storePayload(c,a.payload);Dj(b,c,d==="gelDebuggingEvent")}}
function Dj(a,b,c=!1){a&&(jj=new a);a=T("tvhtml5_logging_max_batch_ads_fork")||T("tvhtml5_logging_max_batch")||T("web_logging_max_batch")||100;const d=W(),e=Ej(!1,b.tier),f=e.l;c&&(e.j=!0);c=0;b&&(c=wj().getSequenceCount(b));c>=1E3?Fj({writeThenSend:!0},!1,b.tier):c>=a?pj||(pj=Gj(()=>{Fj({writeThenSend:!0},!1,b.tier);pj=void 0},0)):d-f>=10&&(Hj(!1,b.tier),e.l=d)}
function Cj(a,b){if(a.endpoint==="log_event"){S("more_accurate_gel_parser")&&wj().storePayload({isJspb:!1},a.payload);yj();var c=zj(a),d=new Map;d.set(c,[a.payload]);var e=Aj(a.payload)||"";b&&(jj=new b);return new L((f,g)=>{jj&&jj.isReady()?Ij(d,jj,f,g,{bypassNetworkless:!0},!0,e==="gelDebuggingEvent"):f()})}}
function zj(a){var b="";if(a.dangerousLogToVisitorSession)b="visitorOnlyApprovedKey";else if(a.cttAuthInfo){b=a.cttAuthInfo;const c={};b.videoId?c.videoId=b.videoId:b.playlistId&&(c.playlistId=b.playlistId);tj[a.cttAuthInfo.token]=c;b=a.cttAuthInfo.token}return b}
function Fj(a={},b=!1,c){new L((d,e)=>{const f=Ej(b,c),g=f.j;f.j=!1;Jj(f.i);Jj(f.h);f.h=0;jj&&jj.isReady()?c===void 0&&S("enable_web_tiered_gel")?Kj(d,e,a,b,300,g):Kj(d,e,a,b,c,g):(Hj(b,c),d())})}
function Kj(a,b,c={},d=!1,e=200,f=!1){var g=jj,h=new Map;const k=new Map,l={isJspb:d,cttAuthInfo:void 0,tier:e},p={isJspb:d,cttAuthInfo:void 0};if(d){for(const n of Object.keys(vj))b=S("enable_web_tiered_gel")?wj().smartExtractMatchingEntries({keys:[l,p],sizeLimit:1E3}):wj().extractMatchingEntries({isJspb:!0,cttAuthInfo:n}),b.length>0&&h.set(n,b),(S("web_fp_via_jspb_and_json")&&c.writeThenSend||!S("web_fp_via_jspb_and_json"))&&delete vj[n];Lj(h,g,a,c,f)}else{for(const n of Object.keys(vj))h=S("enable_web_tiered_gel")?
wj().smartExtractMatchingEntries({keys:[{isJspb:!1,cttAuthInfo:n,tier:e},{isJspb:!1,cttAuthInfo:n}],sizeLimit:1E3}):wj().extractMatchingEntries({isJspb:!1,cttAuthInfo:n}),h.length>0&&k.set(n,h),(S("web_fp_via_jspb_and_json")&&c.writeThenSend||!S("web_fp_via_jspb_and_json"))&&delete vj[n];Ij(k,g,a,b,c,!1,f)}}
function Hj(a=!1,b=200){const c=()=>{Fj({writeThenSend:!0},a,b)},d=Ej(a,b);
var e=d===oj||d===nj?5E3:hj;S("web_gel_timeout_cap")&&!d.h&&(e=Gj(()=>{c()},e),d.h=e);
Jj(d.i);e=R("LOGGING_BATCH_TIMEOUT",T("web_gel_debounce_ms",1E4));S("shorten_initial_gel_batch_timeout")&&qj&&(e=gj);e=Gj(()=>{T("gel_min_batch_size")>0?wj().getSequenceCount({cttAuthInfo:void 0,isJspb:a,tier:b})>=ij&&c():c()},e);
d.i=e}
function Ij(a,b,c,d,e={},f,g){const h=Math.round(W());let k=a.size;const l=Mj(g);for(const [p,n]of a){a=p;g=n;const q=Kd({context:Rh(b.config_||Qh())});if(!ha(g)&&!S("throw_err_when_logevent_malformed_killswitch")){d();break}q.events=g;(g=tj[a])&&Nj(q,a,g);delete tj[a];const m=a==="visitorOnlyApprovedKey";Oj(q,h,m);Pj(e);const u=G=>{S("start_client_gcf")&&pg.h(()=>r(function*(){yield Qj(G)}));
k--;k||c()};
let B=0;const y=()=>{B++;if(e.bypassNetworkless&&B===1)try{qi(b,l,q,Rj({writeThenSend:!0},m,u,y,f)),qj=!1}catch(G){wf(G),d()}k--;k||c()};
try{qi(b,l,q,Rj(e,m,u,y,f)),qj=!1}catch(G){wf(G),d()}}}
function Lj(a,b,c,d={},e){const f=Math.round(W()),g={value:a.size};var h=new Map([...a]);for(const [B]of h){var k=B,l=a.get(k);h=new Ye;var p=b.config_||Qh(),n=new Ue,q=new Me;J(q,1,p.ka);J(q,2,p.ja);E(q,16,lc(p.Ca));J(q,17,p.innertubeContextClientVersion);if(p.Z){var m=p.Z,u=new Ke;m.coldConfigData&&J(u,1,m.coldConfigData);m.appInstallData&&J(u,6,m.appInstallData);m.coldHashData&&J(u,3,m.coldHashData);m.hotHashData&&J(u,5,m.hotHashData);H(q,Ke,62,u)}if((m=t.devicePixelRatio)&&m!=1){if(m!=null&&typeof m!==
"number")throw Error(`Value of float/double field must be a number, found ${typeof m}: ${m}`);E(q,65,m)}m=Lf();m!==""&&J(q,54,m);m=Mf();if(m.length>0){u=new Qe;for(let y=0;y<m.length;y++){const G=new Ne;J(G,1,m[y].key);Pc(G,2,Oe,pc(m[y].value));Wc(u,15,Ne,G)}H(n,Qe,5,u)}Sh(n);Th(p,q);S("start_client_gcf")&&Uh(q);R("DELEGATED_SESSION_ID")&&!S("pageid_as_header_web")&&(p=new Te,J(p,3,R("DELEGATED_SESSION_ID")));!S("fill_delegate_context_in_gel_killswitch")&&(m=R("INNERTUBE_CONTEXT_SERIALIZED_DELEGATION_CONTEXT"))&&
(u=Tc(n,Te,3)||new Te,p=n,m=J(u,18,m),H(p,Te,3,m));p=q;m=R("DEVICE","");for(const [y,G]of Object.entries(Df(m)))m=y,u=G,m==="cbrand"?J(p,12,u):m==="cmodel"?J(p,13,u):m==="cbr"?J(p,87,u):m==="cbrver"?J(p,88,u):m==="cos"?J(p,18,u):m==="cosver"?J(p,19,u):m==="cplatform"&&E(p,42,lc(hg(u)));n.j(q);H(h,Ue,1,n);if(q=uj[k])a:{if(Yc(q,1))n=1;else if(q.getPlaylistId())n=2;else break a;H(h,Xe,4,q);q=Tc(h,Ue,1)||new Ue;p=Tc(q,Te,3)||new Te;m=new Se;J(m,2,k);E(m,1,lc(n));Wc(p,12,Se,m);H(q,Te,3,p)}delete uj[k];
k=k==="visitorOnlyApprovedKey";Sj()||E(h,2,f==null?f:oc(f));!k&&(n=R("EVENT_ID"))&&(q=Tj(),p=new We,J(p,1,n),E(p,2,q==null?q:oc(q)),H(h,We,5,p));Pj(d);if(S("jspb_serialize_with_worker")){ki||((n=R("WORKER_SERIALIZATION_URL"))?((n=n.privateDoNotAccessOrElseTrustedResourceUrlWrappedValue)?(ra===void 0&&(ra=sa()),q=ra,n=new ta(q?q.createScriptURL(n):n)):n=null,ki=n):ki=null);q=ki||void 0;if(!ji&&q!==void 0){n=Worker;if(q instanceof ta)q=q.h;else throw Error("");ji=new n(q,void 0)}if((n=ji)&&d.writeThenSend){sj.set(rj,
{client:b,resolve:c,networklessOptions:d,isIsolated:!1,useVSSEndpoint:e,dangerousLogToVisitorSession:k,requestsOutstanding:g});a=n;b=a.postMessage;c=Ac(h);b.call(a,{op:"gelBatchToSerialize",batchRequest:c,clientEvents:l,key:rj});rj++;break}}if(l){n=[];for(q=0;q<l.length;q++)try{n.push(new Ve(l[q]))}catch(y){wf(new O("Transport failed to deserialize "+String(l[q])))}l=n}else l=[];for(const y of l)Wc(h,3,Ve,y);l={startTime:W(),ticks:{},infos:{}};h=JSON.stringify(Ac(h));l.ticks.geljspc=W();S("log_jspb_serialize_latency")&&
Math.random()<.001&&ci("meta_logging_csi_event",{timerName:"gel_jspb_serialize",Vb:l});Uj(h,b,c,d,e,k,g)}}
function Uj(a,b,c,d={},e,f,g={value:0}){e=Mj(e);d=Rj(d,f,h=>{S("start_client_gcf")&&pg.h(()=>r(function*(){yield Qj(h)}));
g.value--;g.value||c()},()=>{g.value--;
g.value||c()},!1);
d.headers["Content-Type"]="application/json+protobuf";d.postBodyFormat="JSPB";d.postBody=a;qi(b,e,"",d);qj=!1}
function Pj(a){S("always_send_and_write")&&(a.writeThenSend=!1)}
function Rj(a,b,c,d,e){a={retry:!0,onSuccess:c,onError:d,networklessOptions:a,dangerousLogToVisitorSession:b,vb:!!e,headers:{},postBodyFormat:"",postBody:"",compress:S("compress_gel")||S("compress_gel_lr")};Sj()&&(a.headers["X-Goog-Request-Time"]=JSON.stringify(Math.round(W())));return a}
function Oj(a,b,c){Sj()||(a.requestTimeMs=String(b));S("unsplit_gel_payloads_in_logs")&&(a.unsplitGelPayloadsInLogs=!0);!c&&(b=R("EVENT_ID"))&&(c=Tj(),a.serializedClientEventId={serializedEventId:b,clientCounter:String(c)})}
function Tj(){let a=R("BATCH_CLIENT_COUNTER")||0;a||(a=Math.floor(Math.random()*65535/2));a++;a>65535&&(a=1);Q("BATCH_CLIENT_COUNTER",a);return a}
function Nj(a,b,c){let d;if(c.videoId)d="VIDEO";else if(c.playlistId)d="PLAYLIST";else return;a.credentialTransferTokenTargetId=c;a.context=a.context||{};a.context.user=a.context.user||{};a.context.user.credentialTransferTokens=[{token:b,scope:d}]}
function yj(){var a;(a=v("yt.logging.transport.enableScrapingForTest"))||(a=Kf("il_payload_scraping"),a=(a!==void 0?String(a):"")!=="enable_il_payload_scraping");a||(aj=[],w("yt.logging.transport.enableScrapingForTest",!0),w("yt.logging.transport.scrapedPayloadsForTesting",aj),w("yt.logging.transport.payloadToScrape","visualElementShown visualElementHidden visualElementAttached screenCreated visualElementGestured visualElementStateChanged".split(" ")),w("yt.logging.transport.getScrapedPayloadFromClientEventsFunction"),
w("yt.logging.transport.scrapeClientEvent",!0))}
function Sj(){return S("use_request_time_ms_header")||S("lr_use_request_time_ms_header")}
function Gj(a,b){return S("transport_use_scheduler")===!1?Hf(a,b):S("logging_avoid_blocking_during_navigation")||S("lr_logging_avoid_blocking_during_navigation")?jg(()=>{Yi().currentState==="none"?a():Yi().install({none:{callback:a}})},b):jg(a,b)}
function Jj(a){S("transport_use_scheduler")?pg.R(a):window.clearTimeout(a)}
function Qj(a){return r(function*(){var b,c=a==null?void 0:(b=a.responseContext)==null?void 0:b.globalConfigGroup;b=fj(c,Ie);const d=c==null?void 0:c.hotHashData,e=fj(c,He);c=c==null?void 0:c.coldHashData;const f=Di().resolve(new vi);f&&(d&&(b?yield Mh(f,d,b):yield Mh(f,d)),c&&(e?yield Nh(f,c,e):yield Nh(f,c)))})}
function Ej(a,b=200){return a?b===300?oj:mj:b===300?nj:lj}
function Aj(a){a=Object.keys(a);for(const b of a)if(li[b])return b}
function Bj(a){switch(a){case "DELAYED_EVENT_TIER_UNSPECIFIED":return 0;case "DELAYED_EVENT_TIER_DEFAULT":return 100;case "DELAYED_EVENT_TIER_DISPATCH_TO_EMPTY":return 200;case "DELAYED_EVENT_TIER_FAST":return 300;case "DELAYED_EVENT_TIER_IMMEDIATE":return 400;default:return 200}}
function Mj(a=!1){return a&&S("vss_through_gel_video_stats")?"video_stats":"log_event"}
;const Vj=t.ytLoggingGelSequenceIdObj_||{};
function Wj(a,b,c,d={}){const e={},f=Math.round(d.timestamp||W());e.eventTimeMs=f<Number.MAX_SAFE_INTEGER?f:0;e[a]=b;a=v("_lact",window);a=a==null?-1:Math.max(Date.now()-a,0);e.context={lastActivityMs:String(d.timestamp||!isFinite(a)?-1:a)};d.sequenceGroup&&!S("web_gel_sequence_info_killswitch")&&(a=e.context,b=d.sequenceGroup,Vj[b]=b in Vj?Vj[b]+1:0,a.sequence={index:Vj[b],groupKey:b},d.endOfSequence&&delete Vj[d.sequenceGroup]);(d.sendIsolatedPayload?Cj:xj)({endpoint:"log_event",payload:e,cttAuthInfo:d.cttAuthInfo,
dangerousLogToVisitorSession:d.dangerousLogToVisitorSession},c)}
function Xj(a=!1){Fj(void 0,a)}
;let Yj=[];function Y(a,b,c={}){let d=ri;R("ytLoggingEventsDefaultDisabled",!1)&&ri===ri&&(d=null);Wj(a,b,d,c)}
;var Zj=new Set,ak=0,bk=0,ck=0,dk=[];const ek=[],fk=["PhantomJS","Googlebot","TO STOP THIS SECURITY SCAN go/scan"];function gk(a){hk(a)}
function ik(a){hk(a,"WARNING")}
function hk(a,b="ERROR"){var c={};c.name=R("INNERTUBE_CONTEXT_CLIENT_NAME",1);c.version=R("INNERTUBE_CONTEXT_CLIENT_VERSION");jk(a,c,b)}
function jk(a,b,c="ERROR"){if(a){a.hasOwnProperty("level")&&a.level&&(c=a.level);if(S("console_log_js_exceptions")){var d=[];d.push(`Name: ${a.name}`);d.push(`Message: ${a.message}`);a.hasOwnProperty("params")&&d.push(`Error Params: ${JSON.stringify(a.params)}`);a.hasOwnProperty("args")&&d.push(`Error args: ${JSON.stringify(a.args)}`);d.push(`File name: ${a.fileName}`);d.push(`Stacktrace: ${a.stack}`);window.console.log(d.join("\n"),a)}if(!(ak>=5)){d=[];for(e of ek)try{e()&&d.push(e())}catch(u){}var e=
d;e=[...dk,...e];var f=Aa(a);d=f.message||"Unknown Error";const q=f.name||"UnknownError";var g=f.stack||a.i||"Not available";if(g.startsWith(`${q}: ${d}`)){var h=g.split("\n");h.shift();g=h.join("\n")}h=f.lineNumber||"Not available";f=f.fileName||"Not available";let m=0;if(a.hasOwnProperty("args")&&a.args&&a.args.length)for(var k=0;k<a.args.length&&!(m=ag(a.args[k],`params.${k}`,b,m),m>=500);k++);else if(a.hasOwnProperty("params")&&a.params){const u=a.params;if(typeof a.params==="object")for(k in u){if(!u[k])continue;
const B=`params.${k}`,y=cg(u[k]);b[B]=y;m+=B.length+y.length;if(m>500)break}else b.params=cg(u)}if(e.length)for(k=0;k<e.length&&!(m=ag(e[k],`params.context.${k}`,b,m),m>=500);k++);navigator.vendor&&!b.hasOwnProperty("vendor")&&(b["device.vendor"]=navigator.vendor);b={message:d,name:q,lineNumber:h,fileName:f,stack:g,params:b,sampleWeight:1};k=Number(a.columnNumber);isNaN(k)||(b.lineNumber=`${b.lineNumber}:${k}`);if(a.level==="IGNORED")var l=0;else a:{a=Uf();for(l of a.F)if(b.message&&b.message.match(l.Ha)){l=
l.weight;break a}for(var p of a.D)if(p.callback(b)){l=p.weight;break a}l=1}b.sampleWeight=l;l=b;for(var n of Rf)if(n.U[l.name]){p=n.U[l.name];for(const u of p)if(p=l.message.match(u.u)){l.params["params.error.original"]=p[0];a=u.groups;b={};for(k=0;k<a.length;k++)b[a[k]]=p[k+1],l.params[`params.error.${a[k]}`]=p[k+1];l.message=n.ba(b);break}}l.params||(l.params={});n=Uf();l.params["params.errorServiceSignature"]=`msg=${n.F.length}&cb=${n.D.length}`;l.params["params.serviceWorker"]="true";t.document&&
t.document.querySelectorAll&&(l.params["params.fscripts"]=String(document.querySelectorAll("script:not([nonce])").length));(new Nd(Od,"sample")).constructor!==Nd&&(l.params["params.fconst"]="true");window.yterr&&typeof window.yterr==="function"&&window.yterr(l);l.sampleWeight===0||Zj.has(l.message)||kk(l,c)}}}
function kk(a,b="ERROR"){if(b==="ERROR"){Yf.B("handleError",a);if(S("record_app_crashed_web")&&ck===0&&a.sampleWeight===1){ck++;var c={appCrashType:"APP_CRASH_TYPE_BREAKPAD"};S("report_client_error_with_app_crash_ks")||(c.systemHealth={crashData:{clientError:{logMessage:{message:a.message}}}});Y("appCrashed",c)}bk++}else b==="WARNING"&&Yf.B("handleWarning",a);c={};b:{for(e of fk){var d=Ra();if(d&&d.toLowerCase().indexOf(e.toLowerCase())>=0){var e=!0;break b}}e=!1}if(e)c=void 0;else{d={stackTrace:a.stack};
a.fileName&&(d.filename=a.fileName);e=a.lineNumber&&a.lineNumber.split?a.lineNumber.split(":"):[];e.length!==0&&(e.length!==1||isNaN(Number(e[0]))?e.length!==2||isNaN(Number(e[0]))||isNaN(Number(e[1]))||(d.lineNumber=Number(e[0]),d.columnNumber=Number(e[1])):d.lineNumber=Number(e[0]));e={level:"ERROR_LEVEL_UNKNOWN",message:a.message,errorClassName:a.name,sampleWeight:a.sampleWeight};b==="ERROR"?e.level="ERROR_LEVEL_ERROR":b==="WARNING"&&(e.level="ERROR_LEVEL_WARNNING");d={isObfuscated:!0,browserStackInfo:d};
c.pageUrl=window.location.href;c.kvPairs=[];R("FEXP_EXPERIMENTS")&&(c.experimentIds=R("FEXP_EXPERIMENTS"));var f=R("LATEST_ECATCHER_SERVICE_TRACKING_PARAMS");const k=sf.EXPERIMENT_FLAGS;if((!k||!k.web_disable_gel_stp_ecatcher_killswitch)&&f)for(var g of Object.keys(f))c.kvPairs.push({key:g,value:String(f[g])});if(g=a.params)for(var h of Object.keys(g))c.kvPairs.push({key:`client.${h}`,value:String(g[h])});h=R("SERVER_NAME");g=R("SERVER_VERSION");h&&g&&(c.kvPairs.push({key:"server.name",value:h}),
c.kvPairs.push({key:"server.version",value:g}));c={errorMetadata:c,stackTrace:d,logMessage:e}}if(c&&(Y("clientError",c),b==="ERROR"||S("errors_flush_gel_always_killswitch")))a:{if(S("web_fp_via_jspb")){b=Yj;Yj=[];if(b)for(const k of b)Wj(k.N,k.payload,ri,k.options);Xj(!0);if(!S("web_fp_via_jspb_and_json"))break a}Xj()}try{Zj.add(a.message)}catch(k){}ak++}
function lk(a,...b){a.args||(a.args=[]);Array.isArray(a.args)&&a.args.push(...b)}
;function mk(a){return r(function*(){var b=yield t.fetch(a.i);if(b.status!==200)return Promise.reject("Server error when retrieving AmbientData");b=yield b.text();if(!b.startsWith(")]}'\n"))return Promise.reject("Incorrect JSPB formatting");a:{b=JSON.parse(b.substring(5));for(let c=0;c<b.length;c++)if(b[c][0]==="yt.sw.adr"){b=new of(b[c]);break a}b=null}return b?b:Promise.reject("AmbientData missing from response")})}
function nk(a=!1){const b=ok.instance;return r(function*(){if(a||!b.h)b.h=mk(b).then(b.j).catch(c=>{delete b.h;hk(c)});
return b.h})}
var ok=class{constructor(){this.i=pk("/sw.js_data")}j(a){const b=Tc(a,nf,2);if(b){var c=Xc(b,5);c&&(t.__SAPISID=c);I(b,10)!=null?Q("EOM_VISITOR_DATA",Xc(b,10)):I(b,7)!=null&&Q("VISITOR_DATA",Xc(b,7));if(nc(Jc(b,4))!=null){c=String;let e;var d=(e=nc(Jc(b,4)))!=null?e:0;Q("SESSION_INDEX",c(d))}I(b,8)!=null&&Q("DELEGATED_SESSION_ID",Xc(b,8));I(b,12)!=null&&Q("USER_SESSION_ID",Xc(b,12));I(b,11)!=null&&Q("INNERTUBE_CONTEXT_SERIALIZED_DELEGATION_CONTEXT",Xc(b,11))}return a}};function qk(a,b){b.encryptedTokenJarContents&&(a.h[b.encryptedTokenJarContents]=b,typeof b.expirationSeconds==="string"&&setTimeout(()=>{delete a.h[b.encryptedTokenJarContents]},Number(b.expirationSeconds)*1E3))}
var rk=class{constructor(){this.h={}}handleResponse(a,b){if(!b)throw Error("request needs to be passed into ConsistencyService");let c,d;b=((c=b.G.context)==null?void 0:(d=c.request)==null?void 0:d.consistencyTokenJars)||[];let e;if(a=(e=a.responseContext)==null?void 0:e.consistencyTokenJar){for(const f of b)delete this.h[f.encryptedTokenJarContents];qk(this,a)}}};let sk=Date.now().toString();function tk(){if(window.crypto&&window.crypto.getRandomValues)try{var a=Array(16),b=new Uint8Array(16);window.crypto.getRandomValues(b);for(var c=0;c<a.length;c++)a[c]=b[c];return a}catch(d){}a=Array(16);for(b=0;b<16;b++){c=Date.now();for(let d=0;d<c%23;d++)a[b]=Math.random();a[b]=Math.floor(Math.random()*256)}if(sk)for(b=1,c=0;c<sk.length;c++)a[b%16]^=a[(b-1)%16]/4^sk.charCodeAt(c),b++;return a}
;var uk;let vk=t.ytLoggingDocDocumentNonce_;if(!vk){const a=tk(),b=[];for(let c=0;c<a.length;c++)b.push("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_".charAt(a[c]&63));vk=b.join("")}uk=vk;var wk={Ta:0,Qa:1,Sa:2,fb:3,Va:4,rb:5,gb:6,nb:7,lb:8,mb:9,qb:10,kb:11,0:"DEFAULT",1:"CHAT",2:"CONVERSATIONS",3:"MINIPLAYER",4:"DIALOG",5:"VOZ",6:"MUSIC_WATCH_TABS",7:"SHARE",8:"PUSH_NOTIFICATIONS",9:"RICH_GRID_WATCH",10:"UNPLUGGED_BROWSE",11:"PICTURE_IN_PICTURE"};let xk=1;function yk(a){return new zk({trackingParams:a})}
function Ak(a,b,c,d,e,f){const g=xk++;return new zk({veType:a,veCounter:g,elementIndex:c,dataElement:b,youtubeData:d,jspbYoutubeData:e,loggingDirectives:f})}
var zk=class{constructor(a){this.h=a}getAsJson(){const a={};this.h.trackingParams!==void 0?a.trackingParams=this.h.trackingParams:(a.veType=this.h.veType,this.h.veCounter!==void 0&&(a.veCounter=this.h.veCounter),this.h.elementIndex!==void 0&&(a.elementIndex=this.h.elementIndex));this.h.dataElement!==void 0&&(a.dataElement=this.h.dataElement.getAsJson());this.h.youtubeData!==void 0&&(a.youtubeData=this.h.youtubeData);this.h.isCounterfactual&&(a.isCounterfactual=!0);return a}getAsJspb(){const a=new Pe;
if(this.h.trackingParams!==void 0)a.setTrackingParams(this.h.trackingParams);else{if(this.h.veType!==void 0){var b=this.h.veType;E(a,2,b==null?b:mc(b))}this.h.veCounter!==void 0&&(b=this.h.veCounter,E(a,6,b==null?b:mc(b)));this.h.elementIndex!==void 0&&(b=this.h.elementIndex,E(a,3,b==null?b:mc(b)));this.h.isCounterfactual&&E(a,5,!0)}this.h.dataElement!==void 0&&(b=this.h.dataElement.getAsJspb(),H(a,Pe,7,b));this.h.youtubeData!==void 0&&H(a,Je,8,this.h.jspbYoutubeData);return a}toString(){return JSON.stringify(this.getAsJson())}isClientVe(){return!this.h.trackingParams&&
!!this.h.veType}getLoggingDirectives(){return this.h.loggingDirectives}};function Bk(a=0){return R("client-screen-nonce-store",{})[a]}
function Ck(a,b=0){let c=R("client-screen-nonce-store");c||(c={},Q("client-screen-nonce-store",c));c[b]=a}
function Dk(a=0){return a===0?"ROOT_VE_TYPE":`${"ROOT_VE_TYPE"}.${a}`}
function Ek(a=0){return R(Dk(a))}
function Fk(a=0){return(a=Ek(a))?new zk({veType:a,youtubeData:void 0,jspbYoutubeData:void 0}):null}
function Gk(){let a=R("csn-to-ctt-auth-info");a||(a={},Q("csn-to-ctt-auth-info",a));return a}
function Hk(){return Object.values(R("client-screen-nonce-store",{})).filter(a=>a!==void 0)}
function Z(a=0){a=Bk(a);if(!a&&!R("USE_CSN_FALLBACK",!0))return null;a||(a="UNDEFINED_CSN");return a?a:null}
function Ik(a){for(const b of Object.values(wk))if(Z(b)===a)return!0;return!1}
function Jk(a,b,c){const d=Gk();(c=Z(c))&&delete d[c];b&&(d[a]=b)}
function Kk(a){return Gk()[a]}
function Lk(a,b,c=0,d){if(a!==Bk(c)||b!==R(Dk(c)))if(Jk(a,d,c),Ck(a,c),Q(Dk(c),b),b=()=>{setTimeout(()=>{a&&Y("foregroundHeartbeatScreenAssociated",{clientDocumentNonce:uk,clientScreenNonce:a})},0)},"requestAnimationFrame"in window)try{window.requestAnimationFrame(b)}catch(e){b()}else b()}
;function Mk(){var a=R("INNERTUBE_CONTEXT");if(!a)return hk(Error("Error: No InnerTubeContext shell provided in ytconfig.")),{};a=Kd(a);S("web_no_tracking_params_in_shell_killswitch")||delete a.clickTracking;a.client||(a.client={});var b=a.client;b.utcOffsetMinutes=-Math.floor((new Date).getTimezoneOffset());var c=Lf();c?b.experimentsToken=c:delete b.experimentsToken;rk.instance||(rk.instance=new rk);b=rk.instance.h;c=[];let d=0;for(var e in b)c[d++]=b[e];a.request=Object.assign({},a.request,{consistencyTokenJars:c});
a.user=Object.assign({},a.user);if(e=R("INNERTUBE_CONTEXT_SERIALIZED_DELEGATION_CONTEXT"))a.user.serializedDelegationContext=e;return a}
;function Nk(a){var b=a;if(a=R("INNERTUBE_HOST_OVERRIDE")){a=String(a);var c=String,d=b.match(Ea);b=d[5];var e=d[6];d=d[7];let f="";b&&(f+=b);e&&(f+="?"+e);d&&(f+="#"+d);b=a+c(f)}return b}
;function Ok(a){const b={"Content-Type":"application/json"};R("EOM_VISITOR_DATA")?b["X-Goog-EOM-Visitor-Id"]=R("EOM_VISITOR_DATA"):R("VISITOR_DATA")&&(b["X-Goog-Visitor-Id"]=R("VISITOR_DATA"));b["X-Youtube-Bootstrap-Logged-In"]=R("LOGGED_IN",!1);R("DEBUG_SETTINGS_METADATA")&&(b["X-Debug-Settings-Metadata"]=R("DEBUG_SETTINGS_METADATA"));a!=="cors"&&((a=R("INNERTUBE_CONTEXT_CLIENT_NAME"))&&(b["X-Youtube-Client-Name"]=a),(a=R("INNERTUBE_CONTEXT_CLIENT_VERSION"))&&(b["X-Youtube-Client-Version"]=a),(a=
R("CHROME_CONNECTED_HEADER"))&&(b["X-Youtube-Chrome-Connected"]=a),(a=R("DOMAIN_ADMIN_STATE"))&&(b["X-Youtube-Domain-Admin-State"]=a),R("ENABLE_LAVA_HEADER_ON_IT_EXPANSION")&&(a=R("SERIALIZED_LAVA_DEVICE_CONTEXT"))&&(b["X-YouTube-Lava-Device-Context"]=a));return b}
;var Pk=class{constructor(){this.h={}}get(a){if(Object.prototype.hasOwnProperty.call(this.h,a))return this.h[a]}set(a,b){this.h[a]=b}remove(a){delete this.h[a]}};new class{constructor(){this.mappings=new Pk}get(a){a:{var b=this.mappings.get(a.toString());switch(b.type){case "mapping":a=b.value;break a;case "factory":b=b.value();this.mappings.set(a.toString(),{type:"mapping",value:b});a=b;break a;default:a=ua(b,void 0)}}return a}};var Qk=class{},Rk=class extends Qk{};const Sk={GET_DATASYNC_IDS:function(a){return()=>new a}(class extends Rk{})};class Yh extends Wh{constructor(a){super(arguments);this.csn=a}}const fi=new Xh,Tk=[];let Vk=Uk,Wk=0;const Xk=new Map,Yk=new Map,Zk=new Map;
function $k(a,b,c,d,e,f,g,h){const k=Vk(),l=new zk({veType:b,youtubeData:f,jspbYoutubeData:void 0});f=al({},k);e&&(f.cttAuthInfo=e);e={csn:k,pageVe:l.getAsJson()};S("expectation_logging")&&h&&h.screenCreatedLoggingExpectations&&(e.screenCreatedLoggingExpectations=h.screenCreatedLoggingExpectations);c&&c.visualElement?(e.implicitGesture={parentCsn:c.clientScreenNonce,gesturedVe:c.visualElement.getAsJson()},g&&(e.implicitGesture.gestureType=g)):c&&ik(new O("newScreen() parent element does not have a VE - rootVe",
b));d&&(e.cloneCsn=d);a?Wj("screenCreated",e,a,f):Y("screenCreated",e,f);ci(fi,new Yh(k));Xk.clear();Yk.clear();Zk.clear();return k}
function bl(a,b,c,d,e=!1){cl(a,b,c,[d],e)}
function cl(a,b,c,d,e=!1){const f=al({cttAuthInfo:Kk(b)||void 0},b);for(const h of d){var g=h.getAsJson();(Jd(g)||!g.trackingParams&&!g.veType)&&ik(Error("Child VE logged with no data"));if(S("no_client_ve_attach_unless_shown")){const k=dl(h,b);if(g.veType&&!Yk.has(k)&&!Zk.has(k)&&!e){if(!S("il_attach_cache_limit")||Xk.size<1E3){Xk.set(k,[a,b,c,h]);return}S("il_attach_cache_limit")&&Xk.size>1E3&&ik(new O("IL Attach cache exceeded limit"))}g=dl(c,b);Xk.has(g)?el(c,b):Zk.set(g,!0)}}d=d.filter(h=>{h.csn!==
b?(h.csn=b,h=!0):h=!1;return h});
c={csn:b,parentVe:c.getAsJson(),childVes:wa(d,h=>h.getAsJson())};
b==="UNDEFINED_CSN"?fl("visualElementAttached",f,c):a?Wj("visualElementAttached",c,a,f):Y("visualElementAttached",c,f)}
function gl(a,b,c,d,e){hl(a,b,c,e)}
function hl(a,b,c,d){il(c,b);const e=al({cttAuthInfo:Kk(b)||void 0},b);c={csn:b,ve:c.getAsJson(),eventType:1};d&&(c.clientData=d);b==="UNDEFINED_CSN"?fl("visualElementShown",e,c):a?Wj("visualElementShown",c,a,e):Y("visualElementShown",c,e)}
function jl(a,b,c,d=!1){const e=d?16:8;d=al({cttAuthInfo:Kk(b)||void 0,endOfSequence:d},b);c={csn:b,ve:c.getAsJson(),eventType:e};b==="UNDEFINED_CSN"?fl("visualElementHidden",d,c):a?Wj("visualElementHidden",c,a,d):Y("visualElementHidden",c,d)}
function kl(a,b,c,d){var e=void 0;il(c,b);e=e||"INTERACTION_LOGGING_GESTURE_TYPE_GENERIC_CLICK";const f=al({cttAuthInfo:Kk(b)||void 0},b);c={csn:b,ve:c.getAsJson(),gestureType:e};d&&(c.clientData=d);b==="UNDEFINED_CSN"?fl("visualElementGestured",f,c):a?Wj("visualElementGestured",c,a,f):Y("visualElementGestured",c,f)}
function Uk(){let a;a=tk();const b=[];for(let c=0;c<a.length;c++)b.push("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_".charAt(a[c]&63));return b.join("")}
function fl(a,b,c){Tk.push({N:a,payload:c,Cb:void 0,options:b});Wk||(Wk=gi())}
function hi(a){if(Tk){for(const b of Tk)b.payload&&(b.payload.csn=a.csn,Y(b.N,b.payload,b.options));Tk.length=0}Wk=0}
function dl(a,b){return`${a.getAsJson().veType}${a.getAsJson().veCounter}${b}`}
function il(a,b){if(S("no_client_ve_attach_unless_shown")){var c=dl(a,b);Yk.set(c,!0);el(a,b)}}
function el(a,b){a=dl(a,b);Xk.has(a)&&(b=Xk.get(a)||[],bl(b[0],b[1],b[2],b[3],!0),Xk.delete(a))}
function al(a,b){S("log_sequence_info_on_gel_web")&&(a.sequenceGroup=b);return a}
;Object.assign({auto_search:"LATENCY_ACTION_AUTO_SEARCH",ad_to_ad:"LATENCY_ACTION_AD_TO_AD",ad_to_video:"LATENCY_ACTION_AD_TO_VIDEO",app_startup:"LATENCY_ACTION_APP_STARTUP",browse:"LATENCY_ACTION_BROWSE",cast_splash:"LATENCY_ACTION_CAST_SPLASH",channel_activity:"LATENCY_ACTION_KIDS_CHANNEL_ACTIVITY",channels:"LATENCY_ACTION_CHANNELS",chips:"LATENCY_ACTION_CHIPS",commerce_transaction:"LATENCY_ACTION_COMMERCE_TRANSACTION",direct_playback:"LATENCY_ACTION_DIRECT_PLAYBACK",editor:"LATENCY_ACTION_EDITOR",
embed:"LATENCY_ACTION_EMBED",embed_no_video:"LATENCY_ACTION_EMBED_NO_VIDEO",entity_key_serialization_perf:"LATENCY_ACTION_ENTITY_KEY_SERIALIZATION_PERF",entity_key_deserialization_perf:"LATENCY_ACTION_ENTITY_KEY_DESERIALIZATION_PERF",explore:"LATENCY_ACTION_EXPLORE",favorites:"LATENCY_ACTION_FAVORITES",home:"LATENCY_ACTION_HOME",inboarding:"LATENCY_ACTION_INBOARDING",library:"LATENCY_ACTION_LIBRARY",live:"LATENCY_ACTION_LIVE",live_pagination:"LATENCY_ACTION_LIVE_PAGINATION",management:"LATENCY_ACTION_MANAGEMENT",
mini_app:"LATENCY_ACTION_MINI_APP_PLAY",notification_settings:"LATENCY_ACTION_KIDS_NOTIFICATION_SETTINGS",onboarding:"LATENCY_ACTION_ONBOARDING",parent_profile_settings:"LATENCY_ACTION_KIDS_PARENT_PROFILE_SETTINGS",parent_tools_collection:"LATENCY_ACTION_PARENT_TOOLS_COLLECTION",parent_tools_dashboard:"LATENCY_ACTION_PARENT_TOOLS_DASHBOARD",player_att:"LATENCY_ACTION_PLAYER_ATTESTATION",prebuffer:"LATENCY_ACTION_PREBUFFER",prefetch:"LATENCY_ACTION_PREFETCH",profile_settings:"LATENCY_ACTION_KIDS_PROFILE_SETTINGS",
profile_switcher:"LATENCY_ACTION_LOGIN",projects:"LATENCY_ACTION_PROJECTS",reel_watch:"LATENCY_ACTION_REEL_WATCH",results:"LATENCY_ACTION_RESULTS",red:"LATENCY_ACTION_PREMIUM_PAGE_GET_BROWSE",premium:"LATENCY_ACTION_PREMIUM_PAGE_GET_BROWSE",privacy_policy:"LATENCY_ACTION_KIDS_PRIVACY_POLICY",review:"LATENCY_ACTION_REVIEW",search_overview_answer:"LATENCY_ACTION_SEARCH_OVERVIEW_ANSWER",search_ui:"LATENCY_ACTION_SEARCH_UI",search_suggest:"LATENCY_ACTION_SUGGEST",search_zero_state:"LATENCY_ACTION_SEARCH_ZERO_STATE",
secret_code:"LATENCY_ACTION_KIDS_SECRET_CODE",seek:"LATENCY_ACTION_PLAYER_SEEK",settings:"LATENCY_ACTION_SETTINGS",store:"LATENCY_ACTION_STORE",supervision_dashboard:"LATENCY_ACTION_KIDS_SUPERVISION_DASHBOARD",tenx:"LATENCY_ACTION_TENX",video_preview:"LATENCY_ACTION_VIDEO_PREVIEW",video_to_ad:"LATENCY_ACTION_VIDEO_TO_AD",watch:"LATENCY_ACTION_WATCH",watch_it_again:"LATENCY_ACTION_KIDS_WATCH_IT_AGAIN","watch,watch7":"LATENCY_ACTION_WATCH","watch,watch7_html5":"LATENCY_ACTION_WATCH","watch,watch7ad":"LATENCY_ACTION_WATCH",
"watch,watch7ad_html5":"LATENCY_ACTION_WATCH",wn_comments:"LATENCY_ACTION_LOAD_COMMENTS",ww_rqs:"LATENCY_ACTION_WHO_IS_WATCHING",voice_assistant:"LATENCY_ACTION_VOICE_ASSISTANT",cast_load_by_entity_to_watch:"LATENCY_ACTION_CAST_LOAD_BY_ENTITY_TO_WATCH",networkless_performance:"LATENCY_ACTION_NETWORKLESS_PERFORMANCE",gel_compression:"LATENCY_ACTION_GEL_COMPRESSION",gel_jspb_serialize:"LATENCY_ACTION_GEL_JSPB_SERIALIZE",attestation_challenge_fetch:"LATENCY_ACTION_ATTESTATION_CHALLENGE_FETCH"},{"analytics.explore":"LATENCY_ACTION_CREATOR_ANALYTICS_EXPLORE",
"artist.analytics":"LATENCY_ACTION_CREATOR_ARTIST_ANALYTICS","artist.events":"LATENCY_ACTION_CREATOR_ARTIST_CONCERTS","artist.presskit":"LATENCY_ACTION_CREATOR_ARTIST_PROFILE","asset.claimed_videos":"LATENCY_ACTION_CREATOR_CMS_ASSET_CLAIMED_VIDEOS","asset.composition":"LATENCY_ACTION_CREATOR_CMS_ASSET_COMPOSITION","asset.composition_ownership":"LATENCY_ACTION_CREATOR_CMS_ASSET_COMPOSITION_OWNERSHIP","asset.composition_policy":"LATENCY_ACTION_CREATOR_CMS_ASSET_COMPOSITION_POLICY","asset.embeds":"LATENCY_ACTION_CREATOR_CMS_ASSET_EMBEDS",
"asset.history":"LATENCY_ACTION_CREATOR_CMS_ASSET_HISTORY","asset.issues":"LATENCY_ACTION_CREATOR_CMS_ASSET_ISSUES","asset.licenses":"LATENCY_ACTION_CREATOR_CMS_ASSET_LICENSES","asset.metadata":"LATENCY_ACTION_CREATOR_CMS_ASSET_METADATA","asset.ownership":"LATENCY_ACTION_CREATOR_CMS_ASSET_OWNERSHIP","asset.policy":"LATENCY_ACTION_CREATOR_CMS_ASSET_POLICY","asset.references":"LATENCY_ACTION_CREATOR_CMS_ASSET_REFERENCES","asset.shares":"LATENCY_ACTION_CREATOR_CMS_ASSET_SHARES","asset.sound_recordings":"LATENCY_ACTION_CREATOR_CMS_ASSET_SOUND_RECORDINGS",
"asset_group.assets":"LATENCY_ACTION_CREATOR_CMS_ASSET_GROUP_ASSETS","asset_group.campaigns":"LATENCY_ACTION_CREATOR_CMS_ASSET_GROUP_CAMPAIGNS","asset_group.claimed_videos":"LATENCY_ACTION_CREATOR_CMS_ASSET_GROUP_CLAIMED_VIDEOS","asset_group.metadata":"LATENCY_ACTION_CREATOR_CMS_ASSET_GROUP_METADATA","song.analytics":"LATENCY_ACTION_CREATOR_SONG_ANALYTICS",creator_channel_dashboard:"LATENCY_ACTION_CREATOR_CHANNEL_DASHBOARD","channel.analytics":"LATENCY_ACTION_CREATOR_CHANNEL_ANALYTICS","channel.comments":"LATENCY_ACTION_CREATOR_CHANNEL_COMMENTS",
"channel.content":"LATENCY_ACTION_CREATOR_POST_LIST","channel.content.promotions":"LATENCY_ACTION_CREATOR_PROMOTION_LIST","channel.copyright":"LATENCY_ACTION_CREATOR_CHANNEL_COPYRIGHT","channel.editing":"LATENCY_ACTION_CREATOR_CHANNEL_EDITING","channel.monetization":"LATENCY_ACTION_CREATOR_CHANNEL_MONETIZATION","channel.music":"LATENCY_ACTION_CREATOR_CHANNEL_MUSIC","channel.music_storefront":"LATENCY_ACTION_CREATOR_CHANNEL_MUSIC_STOREFRONT","channel.playlists":"LATENCY_ACTION_CREATOR_CHANNEL_PLAYLISTS",
"channel.translations":"LATENCY_ACTION_CREATOR_CHANNEL_TRANSLATIONS","channel.videos":"LATENCY_ACTION_CREATOR_CHANNEL_VIDEOS","channel.live_streaming":"LATENCY_ACTION_CREATOR_LIVE_STREAMING","dialog.copyright_strikes":"LATENCY_ACTION_CREATOR_DIALOG_COPYRIGHT_STRIKES","dialog.video_copyright":"LATENCY_ACTION_CREATOR_DIALOG_VIDEO_COPYRIGHT","dialog.uploads":"LATENCY_ACTION_CREATOR_DIALOG_UPLOADS",owner:"LATENCY_ACTION_CREATOR_CMS_DASHBOARD","owner.allowlist":"LATENCY_ACTION_CREATOR_CMS_ALLOWLIST","owner.analytics":"LATENCY_ACTION_CREATOR_CMS_ANALYTICS",
"owner.art_tracks":"LATENCY_ACTION_CREATOR_CMS_ART_TRACKS","owner.assets":"LATENCY_ACTION_CREATOR_CMS_ASSETS","owner.asset_groups":"LATENCY_ACTION_CREATOR_CMS_ASSET_GROUPS","owner.bulk":"LATENCY_ACTION_CREATOR_CMS_BULK_HISTORY","owner.campaigns":"LATENCY_ACTION_CREATOR_CMS_CAMPAIGNS","owner.channel_invites":"LATENCY_ACTION_CREATOR_CMS_CHANNEL_INVITES","owner.channels":"LATENCY_ACTION_CREATOR_CMS_CHANNELS","owner.claimed_videos":"LATENCY_ACTION_CREATOR_CMS_CLAIMED_VIDEOS","owner.claims":"LATENCY_ACTION_CREATOR_CMS_MANUAL_CLAIMING",
"owner.claims.manual":"LATENCY_ACTION_CREATOR_CMS_MANUAL_CLAIMING","owner.delivery":"LATENCY_ACTION_CREATOR_CMS_CONTENT_DELIVERY","owner.delivery_templates":"LATENCY_ACTION_CREATOR_CMS_DELIVERY_TEMPLATES","owner.issues":"LATENCY_ACTION_CREATOR_CMS_ISSUES","owner.licenses":"LATENCY_ACTION_CREATOR_CMS_LICENSES","owner.pitch_music":"LATENCY_ACTION_CREATOR_CMS_PITCH_MUSIC","owner.policies":"LATENCY_ACTION_CREATOR_CMS_POLICIES","owner.releases":"LATENCY_ACTION_CREATOR_CMS_RELEASES","owner.reports":"LATENCY_ACTION_CREATOR_CMS_REPORTS",
"owner.videos":"LATENCY_ACTION_CREATOR_CMS_VIDEOS","playlist.videos":"LATENCY_ACTION_CREATOR_PLAYLIST_VIDEO_LIST","post.comments":"LATENCY_ACTION_CREATOR_POST_COMMENTS","post.edit":"LATENCY_ACTION_CREATOR_POST_EDIT","promotion.edit":"LATENCY_ACTION_CREATOR_PROMOTION_EDIT","video.analytics":"LATENCY_ACTION_CREATOR_VIDEO_ANALYTICS","video.claims":"LATENCY_ACTION_CREATOR_VIDEO_CLAIMS","video.comments":"LATENCY_ACTION_CREATOR_VIDEO_COMMENTS","video.copyright":"LATENCY_ACTION_CREATOR_VIDEO_COPYRIGHT",
"video.edit":"LATENCY_ACTION_CREATOR_VIDEO_EDIT","video.editor":"LATENCY_ACTION_CREATOR_VIDEO_EDITOR","video.editor_async":"LATENCY_ACTION_CREATOR_VIDEO_EDITOR_ASYNC","video.live_settings":"LATENCY_ACTION_CREATOR_VIDEO_LIVE_SETTINGS","video.live_streaming":"LATENCY_ACTION_CREATOR_VIDEO_LIVE_STREAMING","video.monetization":"LATENCY_ACTION_CREATOR_VIDEO_MONETIZATION","video.policy":"LATENCY_ACTION_CREATOR_VIDEO_POLICY","video.rights_management":"LATENCY_ACTION_CREATOR_VIDEO_RIGHTS_MANAGEMENT","video.translations":"LATENCY_ACTION_CREATOR_VIDEO_TRANSLATIONS"});w("ytLoggingLatencyUsageStats_",t.ytLoggingLatencyUsageStats_||{});const ll=window;class ml{constructor(){this.timing={};this.clearResourceTimings=()=>{};
this.webkitClearResourceTimings=()=>{};
this.mozClearResourceTimings=()=>{};
this.msClearResourceTimings=()=>{};
this.oClearResourceTimings=()=>{}}}
var nl=ll.performance||ll.mozPerformance||ll.msPerformance||ll.webkitPerformance||new ml;la(nl.clearResourceTimings||nl.webkitClearResourceTimings||nl.mozClearResourceTimings||nl.msClearResourceTimings||nl.oClearResourceTimings||Id,nl);const ol=["type.googleapis.com/youtube.api.pfiinnertube.YoutubeApiInnertube.BrowseResponse","type.googleapis.com/youtube.api.pfiinnertube.YoutubeApiInnertube.PlayerResponse"];function pl(a){var b={xb:{}},c=dg();if(yi.instance!==void 0){const d=yi.instance;a=[b!==d.m,a!==d.l,c!==d.j,!1,!1,!1,void 0!==d.i];if(a.some(e=>e))throw new O("InnerTubeTransportService is already initialized",a);
}else yi.instance=new yi(b,a,c)}
function ql(a,b){return r(function*(){var c;const d=a==null?void 0:(c=a.fa)==null?void 0:c.sessionIndex;c=yield me(fg(0,{sessionIndex:d}));return Promise.resolve(Object.assign({},Ok(b),c))})}
function rl(a,b,c,d=()=>{}){return r(function*(){var e;
if(b==null?0:(e=b.G)==null?0:e.context){e=b.G.context;for(var f of[])yield f.Ib(e)}var g;if((g=a.i)==null?0:g.Rb(b.input,b.G))return yield a.i.Eb(b.input,b.G);var h;if((g=(h=b.config)==null?void 0:h.Lb)&&a.h.has(g))var k=a.h.get(g);else{h=JSON.stringify(b.G);let q;f=(q=(k=b.O)==null?void 0:k.headers)!=null?q:{};b.O=Object.assign({},b.O,{headers:Object.assign({},f,c)});k=Object.assign({},b.O);b.O.method==="POST"&&(k=Object.assign({},k,{body:h}));k=a.l.fetch(b.input,k,b.config);g&&a.h.set(g,k)}k=yield k;
var l;let p;if(k&&"error"in k&&((l=k)==null?0:(p=l.error)==null?0:p.details)){l=k.error.details;for(const q of l)(l=q["@type"])&&ol.indexOf(l)>-1&&(delete q["@type"],k=q)}g&&a.h.has(g)&&a.h.delete(g);let n;!k&&((n=a.i)==null?0:n.wb(b.input,b.G))&&(k=yield a.i.Db(b.input,b.G));d();return k||void 0})}
function sl(a,b,c){var d={fa:{identity:gg}};let e=()=>{};
b.context||(b.context=Mk());return new L(f=>r(function*(){var g=Nk(c);g=Gf(g)?"same-origin":"cors";if(a.j.Ma){var h,k=d==null?void 0:(h=d.fa)==null?void 0:h.sessionIndex;h=fg(0,{sessionIndex:k});g=Object.assign({},Ok(g),h)}else g=yield ql(d,g);h=Nk(c);k={};S("json_condensed_response")&&(k.prettyPrint="false");h=Ff(h,k||{},!1);k={method:"POST",mode:Gf(h)?"same-origin":"cors",credentials:Gf(h)?"same-origin":"include"};var l={};const p={};for(const n of Object.keys(l))l[n]&&(p[n]=l[n]);Object.keys(p).length>
0&&(k.headers=p);f(rl(a,{input:h,O:k,G:b,config:d},g,e))}))}
var yi=class{constructor(a,b,c){this.m=a;this.l=b;this.j=c;this.i=void 0;this.h=new Map;a.ea||(a.ea={});a.ea=Object.assign({},Sk,a.ea)}};var xi=new ui;let tl;function ul(){if(!tl){const a=Di();pl({fetch:(b,c)=>me(fetch(new Request(b,c)))});
wi(a);tl=a.resolve(xi)}return tl}
;function vl(a){return r(function*(){yield wl();ik(a)})}
function xl(a){return r(function*(){yield wl();hk(a)})}
function yl(a){r(function*(){var b=yield vh();b?yield pi(a,b):(yield nk(),b={timestamp:a.timestamp},b=a.appShellAssetLoadReport?{N:"appShellAssetLoadReport",payload:a.appShellAssetLoadReport,options:b}:a.clientError?{N:"clientError",payload:a.clientError,options:b}:void 0,b&&Y(b.N,b.payload))})}
function wl(){return r(function*(){try{yield nk()}catch(a){}})}
;var zl=Symbol("trackingData"),Al=new WeakMap;function Bl(){Cl.instance||(Cl.instance=new Cl);return Cl.instance}
function Dl(a){const b=El(a);let c,d;if(S("il_use_view_model_logging_context")&&(b==null?0:(c=b.context)==null?0:(d=c.loggingContext)==null?0:d.loggingDirectives))return b.context.loggingContext.loggingDirectives.trackingParams||"";let e,f;if(b==null?0:(e=b.rendererContext)==null?0:(f=e.loggingContext)==null?0:f.loggingDirectives)return b.rendererContext.loggingContext.loggingDirectives.trackingParams||"";if(b==null?0:b.loggingDirectives)return b.loggingDirectives.trackingParams||"";let g;return((g=
a.veContainer)==null?0:g.trackingParams)?a.veContainer.trackingParams:(b==null?void 0:b.trackingParams)||""}
function Fl(a,b,c){const d=Z(c);return a.csn===null||d===a.csn||c?d:(a=new O("VisibilityLogger called before newScreen",{caller:b.tagName,previous_csn:a.csn,current_csn:d}),ik(a),null)}
function Gl(a){let b;return!((b=El(a))==null||!b.loggingDirectives)}
function Hl(a){a=El(a);return Math.floor(Number(a&&a.loggingDirectives&&a.loggingDirectives.visibility&&a.loggingDirectives.visibility.types||""))||1}
function El(a){let b,c=a.data||((b=a.props)==null?void 0:b.data);if(a.isWebComponentWrapper){let d;c=(d=Al.get(a))==null?void 0:d[zl]}return c}
var Cl=class{constructor(){this.l=new Set;this.i=new Set;this.h=new Map;this.client=void 0;this.csn=null}j(a){this.client=a}m(){this.clear();this.csn=Z()}clear(){this.l.clear();this.i.clear();this.h.clear();this.csn=null}v(a,b,c){var d=Dl(a),e=a.visualElement?a.visualElement:d;b=this.l.has(e);var f=this.h.get(e);this.l.add(e);this.h.set(e,!0);a.impressionLog&&!b&&a.impressionLog();if(d||a.visualElement)if(c=Fl(this,a,c)){var g=Gl(a);if(Hl(a)||g)e=a.visualElement?a.visualElement:yk(d),d=a.interactionLoggingClientData,
g||b?Hl(a)&4?f||(a=this.client,il(e,c),b=al({cttAuthInfo:Kk(c)||void 0},c),f={csn:c,ve:e.getAsJson(),eventType:4},d&&(f.clientData=d),c==="UNDEFINED_CSN"?fl("visualElementShown",b,f):a?Wj("visualElementShown",f,a,b):Y("visualElementShown",f,b)):Hl(a)&1&&!b&&hl(this.client,c,e,d):hl(this.client,c,e,d)}}s(a,b,c){var d=Dl(a);const e=a.visualElement?a.visualElement:d;b=this.i.has(e);const f=this.h.get(e);this.i.add(e);this.h.set(e,!1);if(f===!1)return!0;if(!d&&!a.visualElement)return!1;c=Fl(this,a,c);
if(!c||!Hl(a)&&Gl(a))return!1;d=a.visualElement?a.visualElement:yk(d);Hl(a)&8?jl(this.client,c,d):Hl(a)&2&&!b&&(a=this.client,b=al({cttAuthInfo:Kk(c)||void 0},c),d={csn:c,ve:d.getAsJson(),eventType:2},c==="UNDEFINED_CSN"?fl("visualElementHidden",b,d):a?Wj("visualElementHidden",d,a,b):Y("visualElementHidden",d,b));return!0}};function Il(){Jl.instance||(Jl.instance=new Jl)}
function Kl(a){Il();vf(Bl().v).bind(Bl())(a,void 0,8)}
function Ll(a){Il();vf(Bl().s).bind(Bl())(a,void 0,8)}
var Jl=class{j(a){vf(Bl().j).bind(Bl())(a)}clear(){vf(Bl().clear).bind(Bl())()}};function Ml(){Nl.instance||(Nl.instance=new Nl);return Nl.instance}
function Ol(a,b,c={}){a.i.add(c.layer||0);a.m=()=>{Pl(a,b,c);const d=Fk(c.layer);if(d){for(const e of a.B)Ql(a,e[0],e[1]||d,c.layer);for(const e of a.C)Rl(a,e[0],e[1])}};
Z(c.layer)||a.m();if(c.ha)for(const d of c.ha)Sl(a,d,c.layer);else hk(Error("Delayed screen needs a data promise."))}
function Pl(a,b,c={}){var d=void 0;c.layer||(c.layer=0);d=c.Ia!==void 0?c.Ia:c.layer;const e=Z(d);d=Fk(d);let f;d&&(c.parentCsn!==void 0?f={clientScreenNonce:c.parentCsn,visualElement:d}:e&&e!=="UNDEFINED_CSN"&&(f={clientScreenNonce:e,visualElement:d}));let g;const h=R("EVENT_ID");e==="UNDEFINED_CSN"&&h&&(g={servletData:{serializedServletEventId:h}});S("combine_ve_grafts")&&e&&Tl(a,e);S("no_client_ve_attach_unless_shown")&&d&&e&&el(d,e);let k;try{k=$k(a.client,b,f,c.ga,c.cttAuthInfo,g,c.zb,c.loggingExpectations)}catch(n){lk(n,
{Ob:b,rootVe:d,Hb:void 0,yb:e,Gb:f,ga:c.ga});hk(n);return}Lk(k,b,c.layer,c.cttAuthInfo);e&&e!=="UNDEFINED_CSN"&&d&&!Ik(e)&&jl(a.client,e,d,!0);a.h[a.h.length-1]&&!a.h[a.h.length-1].csn&&(a.h[a.h.length-1].csn=k||"");Il();vf(Bl().m).bind(Bl())();const l=Fk(c.layer);e&&e!=="UNDEFINED_CSN"&&l&&(S("web_mark_root_visible")||S("music_web_mark_root_visible"))&&vf(gl)(void 0,k,l,void 0,void 0,void 0);a.i.delete(c.layer||0);a.m=void 0;let p;(p=a.X.get(c.layer))==null||p.forEach((n,q)=>{n?Ql(a,q,n,c.layer):
l&&Ql(a,q,l,c.layer)});
Ul(a)}
function Vl(a){var b=28631,c={layer:8};vf(()=>{[28631].includes(b)||(ik(new O("createClientScreen() called with a non-page VE",b)),b=83769);c.isHistoryNavigation||a.h.push({rootVe:b,key:c.key||""});a.B=[];a.C=[];c.ha?Ol(a,b,c):Pl(a,b,c)})()}
function Sl(a,b,c=0){vf(()=>{b.then(d=>{a.i.has(c)&&a.m&&a.m();const e=Z(c),f=Fk(c);if(e&&f){var g;(d==null?0:(g=d.response)==null?0:g.trackingParams)&&bl(a.client,e,f,yk(d.response.trackingParams));var h;(d==null?0:(h=d.playerResponse)==null?0:h.trackingParams)&&bl(a.client,e,f,yk(d.playerResponse.trackingParams))}})})()}
function Ql(a,b,c,d=0){return vf(()=>{if(a.i.has(d))return a.B.push([b,c]),!0;const e=Z(d),f=c||Fk(d);if(e&&f){if(S("combine_ve_grafts")){const g=a.l.get(f.toString());g?g.push(b):(a.v.set(f.toString(),f),a.l.set(f.toString(),[b]));a.K||(a.K=jg(()=>{Tl(a,e)},1200))}else bl(a.client,e,f,b);
return!0}return!1})()}
function Wl(a,b){return vf(()=>{const c=yk(b);Ql(a,c,void 0,8);return c})()}
function Tl(a,b){if(b===void 0){const c=Hk();for(let d=0;d<c.length;d++)c[d]!==void 0&&Tl(a,c[d])}else a.l.forEach((c,d)=>{(d=a.v.get(d))&&cl(a.client,b,d,c)}),a.l.clear(),a.v.clear(),a.K=void 0}
function Xl(a,b,c,d=0){if(!b)return!1;d=Z(d);if(!d)return!1;kl(a.client,d,yk(b),c);return!0}
function Rl(a,b,c,d=0){const e=Z(d);b=b||Fk(d);e&&b&&(a=a.client,d=al({cttAuthInfo:Kk(e)||void 0},e),c={csn:e,ve:b.getAsJson(),clientData:c},e==="UNDEFINED_CSN"?fl("visualElementStateChanged",d,c):a?Wj("visualElementStateChanged",c,a,d):Y("visualElementStateChanged",c,d))}
function Ul(a){for(var b=0;b<a.s.length;b++){var c=a.s[b];try{c()}catch(d){hk(d)}}a.s.length=0;for(b=0;b<a.H.length;b++){c=a.H[b];try{c()}catch(d){hk(d)}}}
var Nl=class{constructor(){this.B=[];this.C=[];this.h=[];this.s=[];this.H=[];this.l=new Map;this.v=new Map;this.i=new Set;this.X=new Map}j(a){this.client=a}clickCommand(a,b,c=0){return Xl(this,a.clickTrackingParams,b,c)}stateChanged(a,b,c=0){this.visualElementStateChanged(yk(a),b,c)}visualElementStateChanged(a,b,c=0){c===0&&this.i.has(c)?this.C.push([a,b]):Rl(this,a,b,c)}};const Yl={granted:"GRANTED",denied:"DENIED",unknown:"UNKNOWN"},Zl=RegExp("^(?:[a-z]+:)?//","i");function $l(a){var b=a.data;a=b.type;b=b.data;a==="notifications_register"?(P("IDToken",b),am()):a==="notifications_check_registration"&&bm(b)}
function cm(){return self.clients.matchAll({type:"window",includeUncontrolled:!0}).then(a=>{if(a)for(const b of a)b.postMessage({type:"update_unseen_notifications_count_signal"})})}
function dm(a){const b=[];a.forEach(c=>{b.push({key:c.key,value:c.value})});
return b}
function em(a){return r(function*(){const b=dm(a.payload.chrome.extraUrlParams),c={recipientId:a.recipientId,endpoint:a.payload.chrome.endpoint,extraUrlParams:b},d=mf($e);return fm().then(e=>sl(e,c,d).then(f=>{f.json().then(g=>g&&g.endpointUrl?gm(a,g.endpointUrl):Promise.resolve()).catch(g=>{xl(g);
Promise.reject(g)})}))})}
function hm(a,b){var c=Z(8);if(c==null||!b)return a;a=Zl.test(a)?new URL(a):new URL(a,self.registration.scope);a.searchParams.set("parentCsn",c);a.searchParams.set("parentTrackingParams",b);return a.toString()}
function gm(a,b){a.deviceId&&P("DeviceId",a.deviceId);a.timestampSec&&P("TimestampLowerBound",a.timestampSec);const c=a.payload.chrome,d=Ml();Vl(d);var e;const f=(e=c.postedEndpoint)==null?void 0:e.clickTrackingParams;e=c==null?void 0:c.loggingDirectives;const g=c.title,h={body:c.body,icon:c.iconUrl,data:{nav:hm(b,e==null?void 0:e.trackingParams),id:c.notificationId,attributionTag:c.attributionTag,clickEndpoint:c.clickEndpoint,postedEndpoint:c.postedEndpoint,clickTrackingParams:f,isDismissed:!0,loggingDirectives:e},
tag:c.notificationTag||c.title+c.body+c.iconUrl,requireInteraction:!0};return self.registration.showNotification(g,h).then(()=>{var k;((k=h.data)==null?0:k.postedEndpoint)&&im(h.data.postedEndpoint);let l;if((l=h.data)==null?0:l.loggingDirectives)k=h.data.loggingDirectives,S("enable_client_ve_spec")&&k.clientVeSpec?(k=Ak(k.clientVeSpec.uiType,void 0,k.clientVeSpec.elementIndex,k.clientVeSpec.clientYoutubeData,void 0,k),k=Ql(d,k,void 0,8)?k:null):k=k.trackingParams?Wl(d,k.trackingParams):null,Kl({screenLayer:8,
visualElement:k});jm(a.displayCap)}).catch(()=>{})}
function im(a){if(!fj(a,Ze))return Promise.reject();const b={serializedRecordNotificationInteractionsRequest:fj(a,Ze).serializedInteractionsRequest},c=mf(af);return fm().then(d=>sl(d,b,c)).then(d=>d)}
function jm(a){a!==-1&&self.registration.getNotifications().then(b=>{for(let d=0;d<b.length-a;d++){b[d].data.isDismissed=!1;b[d].close();let e,f;if((e=b[d].data)==null?0:(f=e.loggingDirectives)==null?0:f.trackingParams){var c=yk(b[d].data.loggingDirectives.trackingParams);const g={screenLayer:8,visualElement:c},h=Ak(82046),k=Ml();Ql(k,h,c,8);Kl({screenLayer:8,visualElement:h});(c=Z(8))&&kl(k.client,c,h);Ll(g)}}})}
function bm(a){const b=[km(a),hf("RegistrationTimestamp").then(lm),mm(),nm(),om()];Promise.all(b).catch(()=>{P("IDToken",a);am();return Promise.resolve()})}
function lm(a){return Date.now()-(a||0)<=9E7?Promise.resolve():Promise.reject()}
function km(a){return hf("IDToken").then(b=>a===b?Promise.resolve():Promise.reject())}
function mm(){return hf("Permission").then(a=>Notification.permission===a?Promise.resolve():Promise.reject())}
function nm(){return hf("Endpoint").then(a=>pm().then(b=>a===b?Promise.resolve():Promise.reject()))}
function om(){return hf("application_server_key").then(a=>qm().then(b=>a===b?Promise.resolve():Promise.reject()))}
function rm(){var a=Notification.permission;if(Yl[a])return Yl[a]}
function am(){P("RegistrationTimestamp",0);Promise.all([pm(),sm(),tm(),qm()]).then(([a,b,c,d])=>{b=b?cf(b):null;c=c?cf(c):null;d=d?Za(new Uint8Array(d),4):null;um(a,b,c,d)}).catch(()=>{um()})}
function um(a=null,b=null,c=null,d=null){gf().then(e=>{e&&(P("Endpoint",a),P("P256dhKey",b),P("AuthKey",c),P("application_server_key",d),P("Permission",Notification.permission),Promise.all([hf("DeviceId"),hf("NotificationsDisabled")]).then(([f,g])=>{if(f!=null)var h=f;else{f=[];var k;h=h||Fe.length;for(k=0;k<256;k++)f[k]=Fe[0|Math.random()*h];h=f.join("")}vm(h,a!=null?a:void 0,b!=null?b:void 0,c!=null?c:void 0,d!=null?d:void 0,g!=null?g:void 0)}))})}
function vm(a,b,c,d,e,f){r(function*(){const g={notificationRegistration:{chromeRegistration:{deviceId:a,pushParams:{applicationServerKey:e,authKey:d,p256dhKey:c,browserEndpoint:b},notificationsDisabledInApp:f,permission:rm()}}},h=mf(bf);return fm().then(k=>sl(k,g,h).then(()=>{P("DeviceId",a);P("RegistrationTimestamp",Date.now());P("TimestampLowerBound",Date.now())},l=>{vl(l)}))})}
function pm(){return self.registration.pushManager.getSubscription().then(a=>a?Promise.resolve(a.endpoint):Promise.resolve(null))}
function sm(){return self.registration.pushManager.getSubscription().then(a=>a&&a.getKey?Promise.resolve(a.getKey("p256dh")):Promise.resolve(null))}
function tm(){return self.registration.pushManager.getSubscription().then(a=>a&&a.getKey?Promise.resolve(a.getKey("auth")):Promise.resolve(null))}
function qm(){return self.registration.pushManager.getSubscription().then(a=>a?Promise.resolve(a.options.applicationServerKey):Promise.resolve(null))}
function fm(){return r(function*(){try{return yield nk(!0),ul()}catch(a){return yield vl(a),Promise.reject(a)}})}
;let wm=self.location.origin+"/";function pk(a){let b=typeof ServiceWorkerGlobalScope!=="undefined"&&self instanceof ServiceWorkerGlobalScope?ye.registration.scope:wm;b.endsWith("/")&&(b=b.slice(0,-1));return a==="/"?b:b+a}
;let xm=void 0;function ym(a){return r(function*(){xm||(xm=yield a.open("yt-appshell-assets"));return xm})}
function zm(a,b){return r(function*(){const c=yield ym(a),d=b.map(e=>Am(c,e));
return Promise.all(d)})}
function Bm(a,b){return r(function*(){let c;try{c=yield a.match(b,{cacheName:"yt-appshell-assets"})}catch(d){}return c})}
function Cm(a,b){return r(function*(){const c=yield ym(a),d=(yield c.keys()).filter(e=>!b.includes(e.url)).map(e=>c.delete(e));
return Promise.all(d)})}
function Dm(a,b,c){return r(function*(){yield(yield ym(a)).put(b,c)})}
function Em(a,b){r(function*(){yield(yield ym(a)).delete(b)})}
function Am(a,b){return r(function*(){return(yield a.match(b))?Promise.resolve():a.add(b)})}
;var Fm=Eh("yt-serviceworker-metadata",{M:{auth:{L:1},["resource-manifest-assets"]:{L:2}},shared:!0,upgrade(a,b){b(1)&&Tg(a,"resource-manifest-assets");b(2)&&Tg(a,"auth")},version:2});let Gm=null;function Hm(a){return lh(Fm(),a)}
function Im(){return r(function*(){const a=yield vh();if(a)return Jm.instance||(Jm.instance=new Jm(a)),Jm.instance})}
function Km(a,b){return r(function*(){yield X(yield Hm(a.token),["resource-manifest-assets"],"readwrite",c=>{const d=c.objectStore("resource-manifest-assets"),e=Date.now();return V(d.h.put(b,e)).then(()=>{Gm=e;let f=!0;return Yg(d,{query:IDBKeyRange.bound(0,Date.now()),direction:"prev"},g=>f?(f=!1,gh(g)):d.delete(g.getKey()).then(()=>ah(g)))})})})}
function Lm(a,b){return r(function*(){let c=!1,d=0;yield X(yield Hm(a.token),["resource-manifest-assets"],"readonly",e=>Yg(e.objectStore("resource-manifest-assets"),{query:IDBKeyRange.bound(0,Date.now()),direction:"prev"},f=>{if(f.cursor.value.includes(b))c=!0;else return d+=1,ah(f)}));
return c?d:-1})}
function Mm(a){return r(function*(){Gm||(yield X(yield Hm(a.token),["resource-manifest-assets"],"readonly",b=>Yg(b.objectStore("resource-manifest-assets"),{query:IDBKeyRange.bound(0,Date.now()),direction:"prev"},c=>{Gm=c.getKey()})));
return Gm})}
var Jm=class{constructor(a){this.token=a}};function Nm(){return r(function*(){const a=yield vh();if(a)return Om.instance||(Om.instance=new Om(a)),Om.instance})}
function Pm(a,b){return r(function*(){yield Vg(yield Hm(a.token),"auth",b,"shell_identifier_key")})}
function Qm(a){return r(function*(){return(yield(yield Hm(a.token)).get("auth","shell_identifier_key"))||""})}
function Rm(a){return r(function*(){yield(yield Hm(a.token)).clear("auth")})}
var Om=class{constructor(a){this.token=a}};function Sm(){r(function*(){const a=yield Nm();a&&(yield Rm(a))})}
;var Tm=class extends K{constructor(a){super(a)}hasUrl(){return I(this,1)!=null}};function Um(a){const b=a.o[z]|0;return Uc(a,b,Tm,1,void 0===Jb?2:4,!1,!(2&b))}
var Vm=function(a,b){return(c,d)=>{c=id(c,void 0,void 0,d);try{const f=new a,g=f.o;Dd(b)(g,c);var e=f}finally{md(c)}return e}}(class extends K{constructor(a){super(a)}},[0,
Hd,[0,Gd]]);function Wm(a){return r(function*(){const b=a.headers.get("X-Resource-Manifest");return b?Promise.resolve(Xm(b)):Promise.reject(Error("No resource manifest header"))})}
function Xm(a){return Um(Vm(decodeURIComponent(a))).reduce((b,c)=>{(c=Xc(c,1))&&b.push(c);return b},[])}
;function Ym(a){return r(function*(){const b=yield nk();if(b&&I(b,3)!=null){var c=yield Nm();c&&(c=yield Qm(c),I(b,3)!==c&&(Em(a.caches,a.I),Sm()))}})}
function Zm(a){return r(function*(){let b,c;try{c=yield $m(a.h),b=yield Wm(c),yield zm(a.caches,b)}catch(d){return Promise.reject(d)}try{yield an(),yield Dm(a.caches,a.I,c)}catch(d){return Promise.reject(d)}if(b)try{yield bn(a,b,a.I)}catch(d){}return Promise.resolve()})}
function $m(a){return r(function*(){try{return yield t.fetch(new Request(a))}catch(b){return Promise.reject(b)}})}
function an(){return r(function*(){var a=yield nk();let b;a&&I(a,3)!=null&&(b=Xc(a,3));return b?(a=yield Nm())?Promise.resolve(Pm(a,b)):Promise.reject(Error("Could not get AuthMonitor instance")):Promise.reject(Error("Could not get datasync ID"))})}
function bn(a,b,c){return r(function*(){const d=yield Im();if(d)try{yield Km(d,b)}catch(e){yield vl(e)}b.push(c);try{yield Cm(a.caches,b)}catch(e){yield vl(e)}return Promise.resolve()})}
function cn(a,b){return r(function*(){return Bm(a.caches,b)})}
function dn(a){return r(function*(){return Bm(a.caches,a.I)})}
var en=class{constructor(){var a=self.caches;let b;b=pk("/app_shell");S("service_worker_forward_exp_params")&&(b+=self.location.search);var c=pk("/app_shell_home");this.caches=a;this.h=b;this.I=c}initialize(){const a=this;return r(function*(){yield Ym(a);return Zm(a)})}};var fn=class{constructor(){const a=this;this.stream=new ReadableStream({start(b){a.close=()=>void b.close();
a.h=c=>{const d=c.getReader();return d.read().then(function h({done:f,value:g}){if(f)return Promise.resolve();b.enqueue(g);return d.read().then(h)})};
a.i=()=>{const c=(new TextEncoder).encode("<script>if (window.fetchInitialData) { window.fetchInitialData(); } else { window.getInitialData = undefined; }\x3c/script>");b.enqueue(c)}}})}};function gn(a,b){return r(function*(){const c=b.request,d=yield cn(a.h,c.url);if(d)return a.i&&yl({appShellAssetLoadReport:{assetPath:c.url,cacheHit:!0},timestamp:W()}),d;hn(a,c);return jn(b)})}
function kn(a,b){return r(function*(){const c=yield ln(b);if(c.response&&(c.response.ok||c.response.type==="opaqueredirect"||c.response.status===429||c.response.status===303||c.response.status>=300&&c.response.status<400))return c.response;const d=yield dn(a.h);if(d)return mn(a),nn(d,b);on(a);return c.response?c.response:Promise.reject(c.error)})}
function pn(a,b){b=new URL(b);if(!a.config.ra.includes(b.pathname))return!1;if(!b.search)return!0;b=new URLSearchParams(b.search);for(const c of a.config.ta){if(c.key==="*")return!0;a=b.get(c.key);if(c.value===void 0||a===c.value)if(b.delete(c.key),!b.toString())return!0}return!1}
function qn(a,b){return r(function*(){const c=yield dn(a.h);if(!c)return on(a),jn(b);mn(a);var d;a:{if(c.headers&&(d=c.headers.get("date"))&&(d=Date.parse(d),!isNaN(d))){d=Math.round(W()-d);break a}d=-1}if(!(d>-1&&d/864E5>=7))return nn(c,b);d=yield ln(b);return d.response&&d.response.ok?d.response:nn(c,b)})}
function jn(a){return Promise.resolve(a.preloadResponse).then(b=>b&&!rn(b)?b:t.fetch(a.request))}
function hn(a,b){if(a.i){var c={assetPath:b.url,cacheHit:!1};Im().then(d=>{if(d){var e=Mm(d).then(f=>{f&&(c.currentAppBundleTimestampSec=String(Math.floor(f/1E3)))});
d=Lm(d,b.url).then(f=>{c.appBundleVersionDiffCount=f});
Promise.all([e,d]).catch(f=>{vl(f)}).finally(()=>{yl({appShellAssetLoadReport:c,
timestamp:W()})})}else yl({appShellAssetLoadReport:c,
timestamp:W()})})}}
function mn(a){a.i&&yl({appShellAssetLoadReport:{assetPath:a.h.I,cacheHit:!0},timestamp:W()})}
function on(a){a.i&&yl({appShellAssetLoadReport:{assetPath:a.h.I,cacheHit:!1},timestamp:W()})}
function nn(a,b){if(!S("sw_nav_preload_pbj"))return a;const c=new fn,d=c.h(a.body);Promise.resolve(b.preloadResponse).then(e=>{if(!e||!rn(e))throw Error("no pbj preload response available");d.then(()=>c.h(e.body)).then(()=>void c.close())}).catch(()=>{d.then(()=>{c.i();
c.close()})});
return new Response(c.stream,{status:a.status,statusText:a.statusText,headers:a.headers})}
function ln(a){return r(function*(){try{return{response:yield jn(a)}}catch(b){return{error:b}}})}
function rn(a){return a.headers.get("x-navigation-preload-response-type")==="pbj"}
var An=class{constructor(){var a=sn;var b={ya:tn,Ja:un([vn,/\/signin/,/\/logout/]),ra:["/","/feed/downloads"],ta:wn([{key:"feature",value:"ytca"}]),sa:xn(S("kevlar_sw_app_wide_fallback")?yn:zn)};this.h=a;this.config=b;a=T("app_shell_asset_log_fraction");this.i=!0;a&&(this.i=Math.random()<a)}};const Bn=/^\/$/,zn=[Bn,/^\/feed\/downloads$/],yn=[Bn,/^\/feed\/\w*/,/^\/results$/,/^\/playlist$/,/^\/watch$/,/^\/channel\/\w*/];function xn(a){return new RegExp(a.map(b=>b.source).join("|"))}
const Cn=/^https:\/\/([\w-]*\.)*youtube\.com.*/;function un(a){a=xn(a);return new RegExp(`${Cn.source}(${a.source})`)}
const Dn=xn([/\.css$/,/\.js$/,/\.ico$/,/\/ytmweb\/_\/js\//,/\/ytmweb\/_\/ss\//,/\/kabuki\/_\/js\//,/\/kabuki\/_\/ss\//,/\/ytmainappweb\/_\/js\//,/\/ytmainappweb\/_\/ss\//]),tn=new RegExp(`${Cn.source}(${Dn.source})`),vn=/purge_shell=1/;function wn(a=[]){const b=[];for(const c of Jf)b.push({key:c});for(const c of a)b.push(c);return b}
un([vn]);wn();var Fn=class{constructor(){var a=sn,b=En,c=self;if(t.URLPattern){var d=[];S("service_worker_static_routing_exclude_embed")&&d.push({condition:{urlPattern:new URLPattern({pathname:"/embed*"})},source:"network"});S("service_worker_static_routing_exclude_innertube")&&d.push({condition:{urlPattern:new URLPattern({pathname:"/youtubei/v1/*"})},source:"network"})}else d=[];this.h=c;this.i=a;this.s=b;this.C=df;this.j=d}init(){this.h.oninstall=this.v.bind(this);this.h.onactivate=this.l.bind(this);this.h.onfetch=
this.m.bind(this);this.h.onmessage=this.B.bind(this)}v(a){this.h.skipWaiting();if(S("service_worker_static_routing_registration")&&this.j.length>0&&a.addRoutes)try{a.addRoutes(this.j)}catch(c){}const b=this.i.initialize().catch(c=>{vl(c);return Promise.resolve()});
a.waitUntil(b)}l(a){const b=[this.h.clients.claim()],c=this.h.registration;c.navigationPreload&&(b.push(c.navigationPreload.enable()),S("sw_nav_preload_pbj")&&b.push(c.navigationPreload.setHeaderValue("pbj")));a.waitUntil(Promise.all(b))}m(a){const b=this;return r(function*(){var c=b.s,d=!!b.h.registration.navigationPreload;const e=a.request;if(c.config.Ja.test(e.url))ok.instance&&(delete ok.instance.h,t.__SAPISID=void 0,Q("VISITOR_DATA",void 0),Q("SESSION_INDEX",void 0),Q("DELEGATED_SESSION_ID",
void 0),Q("USER_SESSION_ID",void 0),Q("INNERTUBE_CONTEXT_SERIALIZED_DELEGATION_CONTEXT",void 0)),d=a.respondWith,c=c.h,Em(c.caches,c.I),Sm(),c=jn(a),d.call(a,c);else if(c.config.ya.test(e.url))a.respondWith(gn(c,a));else if(e.mode==="navigate"){const f=new URL(e.url);c.config.sa.test(f.pathname)?a.respondWith(kn(c,a)):pn(c,e.url)?a.respondWith(qn(c,a)):d&&a.respondWith(jn(a))}})}B(a){const b=a.data;
this.C.includes(b.type)?$l(a):b.type==="refresh_shell"&&Zm(this.i).catch(c=>{vl(c)})}};function Gn(){let a=v("ytglobal.storage_");a||(a=new Hn,w("ytglobal.storage_",a));return a}
var Hn=class{estimate(){return r(function*(){const a=navigator;let b;if((b=a.storage)==null?0:b.estimate)return a.storage.estimate();let c;if((c=a.webkitTemporaryStorage)==null?0:c.queryUsageAndQuota)return In()})}};
function In(){const a=navigator;return new Promise((b,c)=>{let d;(d=a.webkitTemporaryStorage)!=null&&d.queryUsageAndQuota?a.webkitTemporaryStorage.queryUsageAndQuota((e,f)=>{b({usage:e,quota:f})},e=>{c(e)}):c(Error("webkitTemporaryStorage is not supported."))})}
w("ytglobal.storageClass_",Hn);function Jn(a,b){Gn().estimate().then(c=>{c=Object.assign({},b,{isSw:self.document===void 0,isIframe:self!==self.top,deviceStorageUsageMbytes:Kn(c==null?void 0:c.usage),deviceStorageQuotaMbytes:Kn(c==null?void 0:c.quota)});a.h("idbQuotaExceeded",c)})}
class Ln{constructor(){var a=Mn;this.handleError=Nn;this.h=a;this.i=!1;self.document===void 0||self.addEventListener("beforeunload",()=>{this.i=!0});
this.j=Math.random()<=.2}S(a,b){switch(a){case "IDB_DATA_CORRUPTED":S("idb_data_corrupted_killswitch")||this.h("idbDataCorrupted",b);break;case "IDB_UNEXPECTEDLY_CLOSED":this.h("idbUnexpectedlyClosed",b);break;case "IS_SUPPORTED_COMPLETED":S("idb_is_supported_completed_killswitch")||this.h("idbIsSupportedCompleted",b);break;case "QUOTA_EXCEEDED":Jn(this,b);break;case "TRANSACTION_ENDED":this.j&&Math.random()<=.1&&this.h("idbTransactionEnded",b);break;case "TRANSACTION_UNEXPECTEDLY_ABORTED":a=Object.assign({},
b,{hasWindowUnloaded:this.i}),this.h("idbTransactionAborted",a)}}}function Kn(a){return typeof a==="undefined"?"-1":String(Math.ceil(a/1048576))}
;Xf(Uf(),{F:[{Ha:/Failed to fetch/,weight:500}],D:[]});({handleError:Nn=gk,S:Mn=Y}={handleError:xl,S:function(a,b){return r(function*(){yield wl();Y(a,b)})}});
var Mn,Nn;for(rg=new Ln;qg.length>0;){const a=qg.shift();switch(a.type){case "ERROR":rg.handleError(a.payload);break;case "EVENT":rg.S(a.eventType,a.payload)}}ok.instance=new ok;self.onnotificationclick=function(a){a.notification.close();const b=a.notification.data;b.isDismissed=!1;const c=self.clients.matchAll({type:"window",includeUncontrolled:!0});c.then(d=>{a:{var e=b.nav;for(const f of d)if(f.url===e){f.focus();break a}self.clients.openWindow(e)}});
a.waitUntil(c);a.waitUntil(im(b.clickEndpoint))};
self.onnotificationclose=function(a){var b=a.notification.data,c;if(b==null?0:(c=b.loggingDirectives)==null?0:c.trackingParams){a=yk(b.loggingDirectives.trackingParams);c={screenLayer:8,visualElement:a};if(b.isDismissed){b=Ak(74726);const d=Ml();Ql(d,b,a,8);Kl({screenLayer:8,visualElement:b});(a=Z(8))&&kl(d.client,a,b)}Ll(c)}};
self.onpush=function(a){a.waitUntil(hf("NotificationsDisabled").then(b=>{if(b)return Promise.resolve();if(a.data&&a.data.text().length)try{return em(a.data.json())}catch(c){return Promise.resolve(c.message)}return Promise.resolve()}));
a.waitUntil(cm())};
self.onpushsubscriptionchange=function(){am()};
const sn=new en,En=new An;(new Fn).init();
