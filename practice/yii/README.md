### Настройка самоподписанного ssl

```
openssl req -x509 -out ~/documents/ssl.crt -keyout ~/documents/ssl.key \
-newkey rsa:2048 -nodes -sha256 \
-subj '/CN=yii-practice.local' -extensions EXT -config <( \
printf "[dn]\nCN=yii-practice.local\n[req]\ndistinguished_name = dn\n[EXT]\nsubjectAltName=DNS:yii-practice.local\nkeyUsage=digitalSignature\nextendedKeyUsage=serverAuth")

openssl dhparam -out ~/documents/dhparam.pem 2048
```