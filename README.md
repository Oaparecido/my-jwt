# ✨ My JWT ✨
📌 Have you ever imagined, create your own json web token ?!<br/>
That's what I'm doing with this project, it will scale, and get very big, using only php

### 🧐 But what is "JWT" !? 🧐
📌 Is a data transfer system, safely, used via POST and HTTP protocols.<br/>
It works in 3 parts, **Header**, **Payload** and **Signature**
 
- 💬 **Header** 

  The header needs **two** data, the type and the hashing algorithm.<br/>
  Hash is usually between **HMAC**, **SHA256** or **RSA**.
  
  ```json
    {
      "alg": "SHA256",
      "typ": "JWT"
    }
  ```
  
- 💬 **Payload**

  Payload are the objects that will be **encrypted**, they are the data that will be sent by the **HTTP** method.<br/>
  There are **3 types** of claims in payloads: **reserved**, **public** and **private** claims.
  
  For **more** information, access:<br/>
    [(JWT) - Learning](https://imasters.com.br/desenvolvimento/json-web-token-conhecendo-o-jwt-na-teoria-e-na-pratica)

  ```json
    {
      "iss": "127.0.0.13",
      "exp": 1300819380,
      "user": "programadriano",
      "admin": true
    }
  ```
  
- 💬 **Signature**

  Signature is the junction of **all hashes**, plus a **secret**, which is a **unique** key encrypted by the **system**.


## 🍻 Thanks for read! 🍻