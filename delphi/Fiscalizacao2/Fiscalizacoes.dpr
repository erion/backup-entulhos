program Fiscalizacoes;

uses
  Forms,
  UPrincipal in 'UPrincipal.pas' {frmPrincipal},
  UdmFiscalizacao in 'UdmFiscalizacao.pas' {dmFiscalizacao: TDataModule},
  Ulogin in 'ULogin.pas' {frmLogin};

{$R *.res}

begin
  Application.Initialize;
  Application.CreateForm(TfrmLogin, frmLogin);
  Application.CreateForm(TdmFiscalizacao, dmFiscalizacao);
  Application.Run;
end.
