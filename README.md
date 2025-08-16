# Henkilörekisterirajapinta

Yksinkertainen HTTP:llä toimiva REST-rajapinta, jolla voi hallita työntekijöitä.
Toimintoja ovat:

    -Työntekijöiden hakeminen. 
        -GET-metodi. Hae kaikki rekisterin työntekijät jättämällä pyynnön body tyhjäksi.
        -GET-metodi. Hae yksittäinen työntekijä id:n perusteella {"id": int}

    -Työntekijän lisääminen. Tämä vaatii kaikki kentät.
        -POST-metodi. {"name": string, "email": string, "phone": int}

    -Työntekijän tietojen muuttaminen.
        -PUT-metodi. Tämä vaatii kaikki kentät vaikka niitä ei muuttaisi. 
        {"id": int, "name": string, "email": string, "phone": int}

    -Työntekijän poistaminen.
        -DELETE-metodi. {"id": int}

SQL-tietokannan employee-taulun rakenne:
```
`employee` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` int(10) DEFAULT NULL
)
```
Projekti on tehty lokaalisti, joten lisäsin pienen Postman-demon kuvana ja tietokannan SQL-tiedostona.