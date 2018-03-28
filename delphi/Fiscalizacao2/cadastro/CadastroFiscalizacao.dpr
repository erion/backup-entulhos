program CadastroFiscalizacao;

uses
  Forms,
  USolicitacao in 'USolicitacao.pas' {frmSolicitacao},
  UdmCadastroFiscalizacao in 'UdmCadastroFiscalizacao.pas' {dmCadastroFiscalizacao: TDataModule},
  UDenuncia in 'UDenuncia.pas' {frmDenuncia},
  UBuscaCidadao in 'UBuscaCidadao.pas' {frmBuscaCidadao};

{$R *.res}

begin
  Application.Initialize;
  Application.CreateForm(TdmCadastroFiscalizacao, dmCadastroFiscalizacao);
  Application.CreateForm(TfrmSolicitacao, frmSolicitacao);
  Application.Run;
end.
