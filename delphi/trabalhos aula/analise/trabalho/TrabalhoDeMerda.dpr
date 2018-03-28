program TrabalhoDeMerda;

uses
  Forms,
  UCadCliente in 'UCadCliente.pas' {frmCadastroCliente},
  UCadFornecedor in 'UCadFornecedor.pas' {frmCadastroFornecedor},
  UCadGuias in 'UCadGuias.pas' {frmCadastroGuias},
  UCadHotel in 'UCadHotel.pas' {frmCadastroHotel},
  UCadMotorista in 'UCadMotorista.pas' {frmCadastroMotorista},
  UNotaFiscal in 'UNotaFiscal.pas' {frmNotaFiscal},
  UPedido in 'UPedido.pas' {frmPedido},
  URoomList in 'URoomList.pas' {frmRoomList},
  UControleOnibus in 'UControleOnibus.pas' {frmControleOnibus},
  UListaPassageiros in 'UListaPassageiros.pas' {frmListaPassageiros},
  UMapaLugares in 'UMapaLugares.pas' {frmMapaLugares},
  UPedidoSeguro in 'UPedidoSeguro.pas' {frmPedidoSeguro},
  USolicitacaoBilhete in 'USolicitacaoBilhete.pas' {frmSolicitacaoBilhete},
  UVouxerExcursao in 'UVouxerExcursao.pas' {frmVoucherExcursao},
  UVoucherHotelaria in 'UVoucherHotelaria.pas' {frmVoucherHotelaria},
  UVoucherLocacaoVeiculos in 'UVoucherLocacaoVeiculos.pas' {frmVoucherLocacaoVeiculos};

{$R *.res}

begin
  Application.Initialize;
  Application.CreateForm(TfrmCadastroCliente, frmCadastroCliente);
  Application.CreateForm(TfrmCadastroFornecedor, frmCadastroFornecedor);
  Application.CreateForm(TfrmCadastroGuias, frmCadastroGuias);
  Application.CreateForm(TfrmCadastroHotel, frmCadastroHotel);
  Application.CreateForm(TfrmCadastroMotorista, frmCadastroMotorista);
  Application.CreateForm(TfrmNotaFiscal, frmNotaFiscal);
  Application.CreateForm(TfrmPedido, frmPedido);
  Application.CreateForm(TfrmRoomList, frmRoomList);
  Application.CreateForm(TfrmControleOnibus, frmControleOnibus);
  Application.CreateForm(TfrmListaPassageiros, frmListaPassageiros);
  Application.CreateForm(TfrmMapaLugares, frmMapaLugares);
  Application.CreateForm(TfrmPedidoSeguro, frmPedidoSeguro);
  Application.CreateForm(TfrmSolicitacaoBilhete, frmSolicitacaoBilhete);
  Application.CreateForm(TfrmVoucherExcursao, frmVoucherExcursao);
  Application.CreateForm(TfrmVoucherHotelaria, frmVoucherHotelaria);
  Application.CreateForm(TfrmVoucherLocacaoVeiculos, frmVoucherLocacaoVeiculos);
  Application.Run;
end.
