unit UdmCadastroFiscalizacao;

interface

uses
  SysUtils, Classes, DB, Wwdatsrc, ADODB;

type
  TdmCadastroFiscalizacao = class(TDataModule)
    dbPmnh: TADOConnection;
    tbSolicitacao: TADOTable;
    tbDenuncia: TADOTable;
    dsSolicitacao: TwwDataSource;
    dsDenuncia: TwwDataSource;
    tbSolicitacaoidsolicitacao: TIntegerField;
    tbSolicitacaoidtiporequerente: TIntegerField;
    tbSolicitacaoidusuario: TIntegerField;
    tbSolicitacaoidrequerente: TIntegerField;
    tbSolicitacaoidorigem: TIntegerField;
    tbSolicitacaoidtipoprotocolo: TIntegerField;
    tbSolicitacaonumprotocolo: TStringField;
    tbSolicitacaodataprotocolo: TDateTimeField;
    tbSolicitacaodatahorasolicitacao: TDateTimeField;
    tbSolicitacaoassunto: TStringField;
    tbSolicitacaoobservacao: TMemoField;
    tbDenunciaiddenuncia: TIntegerField;
    tbDenunciaidsolicitacao: TIntegerField;
    tbDenunciacodlotacao: TStringField;
    tbDenunciaidfiscal: TIntegerField;
    tbDenunciaidsituacao: TIntegerField;
    tbDenunciaidinfrator: TIntegerField;
    tbDenunciadatahoradenuncia: TDateTimeField;
    tbDenunciaassunto: TStringField;
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
    qryLookup: TADOQuery;
    qryValoresChave: TADOQuery;
    qryValoresChavecampo: TStringField;
    qryValoresChavevalor: TIntegerField;
    qryBuscaCidadao: TADOQuery;
    dsBuscaCidadao: TwwDataSource;
    qryBuscaCidadaonome_cidadao: TStringField;
    qryBuscaCidadaocod_cidadao: TIntegerField;
    procedure tbSolicitacaoBeforePost(DataSet: TDataSet);
    procedure tbDenunciaBeforePost(DataSet: TDataSet);
  private
    { Private declarations }
  public
    { Public declarations }

    function getValorCodigo(campo:string): integer;

  end;

var
  dmCadastroFiscalizacao: TdmCadastroFiscalizacao;

implementation

uses USolicitacao, UDenuncia;

{$R *.dfm}

function TdmCadastroFiscalizacao.getValorCodigo(campo:string): integer;
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

procedure TdmCadastroFiscalizacao.tbSolicitacaoBeforePost(
  DataSet: TDataSet);
begin
  if dsSolicitacao.State in [dsinsert] then
    tbSolicitacaoidSolicitacao.AsInteger := getValorCodigo('idsolicitacao');
  frmSolicitacao.StatusBar1.SimpleText := 'Dados inseridos com sucesso!';
  frmSolicitacao.wwDBGrid1IButton.Enabled := true;
end;

procedure TdmCadastroFiscalizacao.tbDenunciaBeforePost(DataSet: TDataSet);
begin
  tbDenunciaiddenuncia.AsInteger := getValorCodigo('iddenuncia');
  tbDenunciaidsituacao.AsInteger := 1;
  tbDenunciaidsolicitacao.Value := StrToInt(frmSolicitacao.idSolicitacao.Text);
  frmDenuncia.StatusBar1.SimpleText := 'Dados inseridos com sucesso!';
end;

end.
