unit UdmFiscalizacao2;

interface

uses
  SysUtils, Classes, DB, ADODB, Wwdatsrc;

type
  TdmFiscalizacao2 = class(TDataModule)
    qrySolicitacaoProtocolo: TADOQuery;
    qrySolicitacaoProtocolodescricao: TStringField;
    qrySolicitacaoProtocoloidtipoprotocolo: TIntegerField;
    qrySolicitacaoRequerente: TADOQuery;
    qrySolicitacaoRequerentedescricao: TStringField;
    qrySolicitacaoRequerenteidtiporequerente: TIntegerField;
    qrySolicitacaoOrigem: TADOQuery;
    qrySolicitacaoOrigemdescricao: TStringField;
    qrySolicitacaoOrigemidorigem: TIntegerField;
    qrySituacao: TADOQuery;
    qrySituacaodescricao: TStringField;
    qrySituacaoidsituacao: TIntegerField;
    qryLotacao: TADOQuery;
    qryLotacaonome: TStringField;
    qryLotacaocodlotacao: TStringField;
    qryLogradouro: TADOQuery;
    qryLogradourodescricao: TStringField;
    qryLogradourocod_logradouro: TIntegerField;
    qryBairro: TADOQuery;
    qryBairronome: TStringField;
    qryBairrocod_bairro: TSmallintField;
    dbPmnh: TADOConnection;
    tbSolicitacao: TADOTable;
    tbSolicitacaoidsolicitacao: TIntegerField;
    tbSolicitacaoidtiporequerente: TIntegerField;
    tbSolicitacaoidusuario: TIntegerField;
    tbSolicitacaoidorigem: TIntegerField;
    tbSolicitacaoidtipoprotocolo: TIntegerField;
    tbSolicitacaonumprotocolo: TStringField;
    tbSolicitacaodataprotocolo: TDateTimeField;
    tbSolicitacaodatahorasolicitacao: TDateTimeField;
    tbSolicitacaoassunto: TStringField;
    tbSolicitacaoobservacao: TMemoField;
    tbSolicitacaoRequerente: TStringField;
    dsSolicitacao: TwwDataSource;
    tbDenuncia: TADOTable;
    tbDenunciaNomeInfrator: TStringField;
    tbDenunciaassunto: TStringField;
    tbDenunciaNomeSecretaria: TStringField;
    tbDenunciacodlotacao: TStringField;
    tbDenunciaiddenuncia: TIntegerField;
    tbDenunciaidfiscal: TIntegerField;
    tbDenunciaidsituacao: TIntegerField;
    tbDenunciadatahoradenuncia: TDateTimeField;
    tbDenunciadescricao: TMemoField;
    tbDenunciaprocedimentos: TMemoField;
    tbDenunciadatahoraatendimento: TDateTimeField;
    tbDenunciaobservacao: TMemoField;
    tbDenunciaidbairroinfracao: TIntegerField;
    tbDenunciaidlogradouroinfracao: TIntegerField;
    tbDenuncianumeroinfracao: TStringField;
    tbDenunciacomplementoinfracao: TStringField;
    tbDenunciasetor: TStringField;
    tbDenunciaquadra: TIntegerField;
    tbDenuncialote: TIntegerField;
    tbDenunciaunidade: TStringField;
    tbDenunciaidsolicitacao: TIntegerField;
    dsCadDenuncia: TwwDataSource;
    qryCidadao: TADOQuery;
    qryCidadaonome_cidadao: TStringField;
    qryCidadaocod_cidadao: TIntegerField;
    dsCidadao: TwwDataSource;
    qryDenunciaSolicitacao: TADOQuery;
    dsDenunciaSolicitacao: TwwDataSource;
    tbSolicitacaoidrequerente: TIntegerField;
    tbDenunciaidinfrator: TIntegerField;
    tbValoresChave: TADOTable;
    tbValoresChavecampo: TStringField;
    tbValoresChavevalor: TFloatField;
    qryValoresChave: TADOQuery;
    qryValoresChavecampo: TStringField;
    qryValoresChavevalor: TIntegerField;
    procedure tbSolicitacaoBeforePost(DataSet: TDataSet);
    procedure tbDenunciaBeforePost(DataSet: TDataSet);
    procedure tbSolicitacaoAfterInsert(DataSet: TDataSet);
  private
    { Private declarations }
  public
    { Public declarations }

    function getValorCodigo(campo:string): integer;

  end;

var
  dmFiscalizacao2: TdmFiscalizacao2;

implementation

{$R *.dfm}

function TdmFiscalizacao2.getValorCodigo(campo:string): integer;
begin
  With qryValoresChave do
  begin
    Close;
    Parameters.ParamByName('campo').Value:=campo;
    Open;
    Last;
    Edit;
    Fieldbyname('valor').Value:= Fieldbyname('valor').Value + 1;
    Post;
  end;
  Result := qryValoresChave.fieldbyname('valor').Value + 1;
end;

procedure TdmFiscalizacao2.tbSolicitacaoBeforePost(DataSet: TDataSet);
begin
  if dsSolicitacao.State in [dsinsert] then
    tbSolicitacaoidSolicitacao.AsInteger := getValorCodigo('idsolicitacao');
end;

procedure TdmFiscalizacao2.tbDenunciaBeforePost(DataSet: TDataSet);
begin
  if dsCaddenuncia.State in [dsinsert] then
    tbDenunciaiddenuncia.AsInteger := getValorCodigo('iddenuncia');
  tbDenunciaidsituacao.AsInteger := 1;
end;

procedure TdmFiscalizacao2.tbSolicitacaoAfterInsert(DataSet: TDataSet);
begin
  tbSolicitacaoidusuario.Value := dmFiscalizacao.qryLoginidusuario.Value;
end;

end.
