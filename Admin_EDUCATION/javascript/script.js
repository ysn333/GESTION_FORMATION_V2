if (window.location.pathname.split("/").pop()===""||window.location.pathname.split("/").pop()==='index.php'){
    document.querySelector("#country").addEventListener("change", () => {
        document.querySelector("#city_modal").innerHTML =" <option value=\"0\" selected disabled>Ville</option>";

        fetch("php/api.php?id=" + document.querySelector("#country").value)
            .then(async (response) => {
                Array = await response.json();
                return Array
            }).then(Array => {
            Array.forEach(city => {
                let option = document.createElement("option");
                option.value = city["name"];
                option.append(city["name"]);
                document.querySelector("#city_modal").append(option);
            })
        })

    })
    document.querySelector("#country_aside").addEventListener("change", () => {
        document.querySelector("#city").innerHTML =" <option value=\"0\" selected disabled>Ville</option>";
        fetch("php/api.php?id=" + document.querySelector("#country_aside").value)
            .then(async (response) => {
                Array = await response.json();
                return Array
            }).then(Array => {
            Array.forEach(city => {
                let option = document.createElement("option");
                option.value = city["name"];
                option.append(city["name"]);
                document.querySelector("#city").append(option);
            })
        })

    })
}else{
    document.querySelector("#country").addEventListener("change", () => {
        document.querySelector("#city_modal").innerHTML =" <option value=\"0\" selected disabled>Ville</option>";
        fetch("api.php?id=" + document.querySelector("#country").value)
            .then(async (response) => {
                Array = await response.json();
                return Array
            }).then(Array => {
            Array.forEach(city => {
                let option = document.createElement("option");
                option.value = city["name"];
                option.append(city["name"]);
                document.querySelector("#city_modal").append(option);
            })
        })

    });
    document.querySelector("#country_aside").addEventListener("change", () => {
        document.querySelector("#city").innerHTML =" <option value=\"0\" selected disabled>Ville</option>";
        fetch("api.php?id=" + document.querySelector("#country_aside").value)
            .then(async (response) => {
                Array = await response.json();
                return Array
            }).then(Array => {
            Array.forEach(city => {
                let option = document.createElement("option");
                option.value = city["name"];
                option.append(city["name"]);
                document.querySelector("#city").append(option);
            })
        })

    })

}