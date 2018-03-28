function confirmDelete(delUrl) {
  if (confirm("Tem certeza que deseja excluir o registro?")) {
    document.location = delUrl;
  }
}