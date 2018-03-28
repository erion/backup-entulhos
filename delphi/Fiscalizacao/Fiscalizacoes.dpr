program Fiscalizacoes;

uses
  Forms,
  UPrincipal in 'UPrincipal.pas' {frmPrincipal},
  UdmFiscalizacao in 'UdmFiscalizacao.pas' {dmFiscalizacao: TDataModule},
  Ulogin in 'ULogin.pas' {frmLogin},
  USolicitacao in 'Usolicitacao.pas' {frmSolicitacao},
  UBuscaCidadao in 'UBuscaCidadao.pas' {frmBuscaCidadao},
  UVisualizaSolicitacao in 'UVisualizaSolicitacao.pas' {frmVisualizaSolicitacao},
  UHistoricoInfrator in 'UHistoricoInfrator.pas' {frmHistoricoInfrator},
  UDenuncia in 'UDenuncia.pas' {frmDenuncia};

{$R *.res}

begin
  Application.Initialize;
  Application.CreateForm(TfrmLogin, frmLogin);
  Application.CreateForm(TdmFiscalizacao, dmFiscalizacao);
  Application.Run;
end.
