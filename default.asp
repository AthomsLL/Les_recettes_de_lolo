<%EnableSessionState=False
host = Request.ServerVariables("HTTP_HOST")

if host = "lesrecettesdelolo.fr" or host = "www.lesrecettesdelolo.fr" then response.redirect("https://www.lesrecettesdelolo.fr/")

else
response.redirect("https://www.lesrecettesdelolo.fr/error.htm")
end if
%>